<?php
// admin/adoption_requests.php
// Admin examines the documents submitted by applicants and validates
// (approves or rejects) their right to adopt.

require_once '../includes/db.php';

$requests = [];
$result = $conn->query("
    SELECT ar.*, p.name AS pet_name
    FROM adoption_requests ar
    LEFT JOIN pets p ON ar.pet_id = p.id
    ORDER BY ar.date_submitted DESC
");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Requests - Pet Adoption Admin</title>

    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <link rel="stylesheet" href="css/adoption_requests.css">
</head>
<body>

<div class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-paw"></i>
        <h2>Pet Adoption</h2>
        <p>Administrator</p>
    </div>

    <ul>
        <li>
            <a href="dashboard.php">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="pet_inventory.php">
                <i class="fa-solid fa-dog"></i>
                Manage Pets
            </a>
        </li>
        <li>
            <a href="manage_users.php">
                <i class="fa-solid fa-users"></i>
                Manage Users
            </a>
        </li>
        <li class="active">
            <a href="adoption_requests.php">
                <i class="fa-solid fa-file-circle-check"></i>
                Adoption Requests
            </a>
        </li>
        <li>
            <a href="reports.php">
                <i class="fa-solid fa-chart-line"></i>
                Reports
            </a>
        </li>
        <li>
            <a href="../logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </li>
    </ul>

</div>

<div class="main">

    <div class="header">
        <div>
            <h1>Adoption Requests</h1>
            <p>Examine submitted documents and validate each applicant's right to adopt.</p>
        </div>
        <div class="profile">
            <i class="fa-solid fa-user-shield"></i>
            <span>Admin</span>
        </div>
    </div>

    <div class="table-container">

        <div class="table-header">
            <div>
                <h2>All Requests</h2>
                <p>Review pending, approved, and rejected adoption requests.</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Application Code</th>
                    <th>Applicant</th>
                    <th>Pet</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                    <th width="280">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $req): ?>
                <tr>
                    <td><?php echo htmlspecialchars($req['application_code']); ?></td>
                    <td><?php echo htmlspecialchars($req['applicant_name']); ?></td>
                    <td><?php echo htmlspecialchars($req['pet_name'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars(date('F j, Y', strtotime($req['date_submitted']))); ?></td>
                    <td>
                        <?php
                        $statusClass = match ($req['status']) {
                            'Approved' => 'available',
                            'Rejected' => 'adopted',
                            default => 'pending',
                        };
                        ?>
                        <span class="badge <?php echo $statusClass; ?>">
                            <?php echo htmlspecialchars($req['status']); ?>
                        </span>
                    </td>
                    <td>
                        <button type="button"
                            class="btn-view"
                            onclick="openDocumentModal(
                                '<?php echo htmlspecialchars($req['application_code']); ?>',
                                '<?php echo htmlspecialchars($req['applicant_name']); ?>',
                                '<?php echo htmlspecialchars($req['valid_id_path']); ?>',
                                '<?php echo htmlspecialchars($req['proof_of_address_path']); ?>',
                                '<?php echo htmlspecialchars($req['additional_doc_path'] ?? ''); ?>',
                                <?php echo (int) $req['id']; ?>
                            )">
                            <i class="fa-solid fa-eye"></i>
                            Examine Documents
                        </button>

                        <?php if ($req['status'] === 'Pending'): ?>
                        <a href="process_adoption.php?id=<?php echo (int) $req['id']; ?>&action=approve"
                            class="btn-approve"
                            onclick="return confirm('Approve this adoption request?');">
                            <i class="fa-solid fa-check"></i>
                            Approve
                        </a>
                        <a href="process_adoption.php?id=<?php echo (int) $req['id']; ?>&action=reject"
                            class="btn-reject"
                            onclick="return confirm('Reject this adoption request?');">
                            <i class="fa-solid fa-xmark"></i>
                            Reject
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>

                <?php if (empty($requests)): ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No adoption requests found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <footer class="footer">
        <p>© 2026 Pet Adoption System | Admin Dashboard</p>
    </footer>

</div>

<!-- Document Examination Modal -->
<div class="modal-overlay" id="documentModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="modalTitle">Examine Documents</h3>
            <button type="button" class="modal-close" onclick="closeDocumentModal()">&times;</button>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Populated by JS -->
        </div>
    </div>
</div>

<script>
function openDocumentModal(code, applicant, validId, proofAddress, additionalDoc, requestId) {
    document.getElementById('modalTitle').textContent = 'Documents - ' + applicant + ' (' + code + ')';

    let body = '';
    body += buildDocRow('Valid Government ID', validId);
    body += buildDocRow('Proof of Address', proofAddress);
    if (additionalDoc) {
        body += buildDocRow('Additional Document', additionalDoc);
    }

    document.getElementById('modalBody').innerHTML = body;
    document.getElementById('documentModal').classList.add('open');
}

function buildDocRow(label, path) {
    if (!path) {
        return `<div class="doc-row"><span>${label}</span><span>Not submitted</span></div>`;
    }
    return `<div class="doc-row"><span>${label}</span><a href="../${path}" target="_blank" class="btn-view">
                <i class="fa-solid fa-eye"></i> View Document
            </a></div>`;
}

function closeDocumentModal() {
    document.getElementById('documentModal').classList.remove('open');
}
</script>

</body>
</html>
