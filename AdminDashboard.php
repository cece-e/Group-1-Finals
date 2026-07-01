<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption Admin Dashboard</title>

    <link rel="stylesheet" href="../css/admin_dashboard.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="sidebar">

    <div class="logo">

        <i class="fa-solid fa-paw"></i>

        <h2>Pet Adoption</h2>

        <p>Administrator</p>

    </div>

    <ul>

        <li class="active">
            <a href="dashboard.php">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="pets.php">
                <i class="fa-solid fa-dog"></i>
                Manage Pets
            </a>
        </li>

        <li>
            <a href="users.php">
                <i class="fa-solid fa-users"></i>
                Manage Users
            </a>
        </li>

        <li>
            <a href="applications.php">
                <i class="fa-solid fa-file-circle-check"></i>
                Applications
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

            <h1>Dashboard</h1>

            <p>
                Welcome back,
                <strong>Administrator</strong>
            </p>

        </div>

        <div class="profile">

            <i class="fa-solid fa-user-shield"></i>

            <span>Admin</span>

        </div>

    </div>

    <div class="cards">

        <div class="card">

            <div class="card-icon">
                <i class="fa-solid fa-paw"></i>
            </div>

            <div>

                <h3>Total Pets</h3>

                <h2>58</h2>

            </div>

        </div>

        <div class="card">

            <div class="card-icon">

                <i class="fa-solid fa-user-group"></i>

            </div>

            <div>

                <h3>Registered Users</h3>

                <h2>31</h2>

            </div>

        </div>

        <div class="card">

            <div class="card-icon">

                <i class="fa-solid fa-file-circle-check"></i>

            </div>

            <div>

                <h3>Pending Requests</h3>

                <h2>9</h2>

            </div>

        </div>

        <div class="card">

            <div class="card-icon">

                <i class="fa-solid fa-heart"></i>

            </div>

            <div>

                <h3>Adopted Pets</h3>

                <h2>42</h2>

            </div>

        </div>

    </div>

    <div class="table-container">

        <div class="table-header">

            <div>

                <h2>Manage Pets</h2>

                <p>Manage all pets available for adoption.</p>

            </div>

            <a href="add_pet.php" class="btn-add">

                <i class="fa-solid fa-plus"></i>

                Add New Pet

            </a>

        </div>

        <div class="toolbar">

            <input
                type="text"
                placeholder="Search pet..."
                class="search-box">

            <select class="filter">

                <option>All Species</option>

                <option>Dog</option>

                <option>Cat</option>

                <option>Rabbit</option>

                <option>Bird</option>

            </select>

            <select class="filter">

                <option>All Status</option>

                <option>Available</option>

                <option>Pending</option>

                <option>Adopted</option>

            </select>

        </div>


        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Photo</th>

                    <th>Name</th>

                    <th>Species</th>

                    <th>Breed</th>

                    <th>Age</th>

                    <th>Status</th>

                    <th width="230">Action</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>1</td>

                    <td>

                        <img src="../images/sample.jpg"
                        class="pet-image">

                    </td>

                    <td>Buddy</td>

                    <td>Dog</td>

                    <td>Golden Retriever</td>

                    <td>2 Years</td>

                    <td>

                        <span class="badge available">

                            Available

                        </span>

                    </td>

                    <td>

                        <a href="edit_pet.php?id=1"
                        class="btn-edit">

                            <i class="fa-solid fa-pen"></i>

                            Edit

                        </a>

                        <a href="delete_pet.php?id=1"
                        class="btn-delete">

                            <i class="fa-solid fa-trash"></i>

                            Delete

                        </a>

                    </td>

                </tr>

                <tr>

                    <td>2</td>

                    <td>

                        <img src="../images/sample.jpg"
                        class="pet-image">

                    </td>

                    <td>Luna</td>

                    <td>Cat</td>

                    <td>Persian</td>

                    <td>1 Year</td>

                    <td>

                        <span class="badge pending">

                            Pending

                        </span>

                    </td>

                    <td>

                        <a href="edit_pet.php?id=2"
                        class="btn-edit">

                            <i class="fa-solid fa-pen"></i>

                            Edit

                        </a>

                        <a href="delete_pet.php?id=2"
                        class="btn-delete">

                            <i class="fa-solid fa-trash"></i>

                            Delete

                        </a>

                    </td>

                </tr>
                                <tr>

                    <td>3</td>

                    <td>

                        <img src="../images/sample.jpg"
                        class="pet-image">

                    </td>

                    <td>Charlie</td>

                    <td>Rabbit</td>

                    <td>Holland Lop</td>

                    <td>3 Years</td>

                    <td>

                        <span class="badge adopted">

                            Adopted

                        </span>

                    </td>

                    <td>

                        <a href="edit_pet.php?id=3"
                        class="btn-edit">

                            <i class="fa-solid fa-pen"></i>

                            Edit

                        </a>

                        <a href="delete_pet.php?id=3"
                        class="btn-delete">

                            <i class="fa-solid fa-trash"></i>

                            Delete

                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <div class="table-container">

        <div class="table-header">

            <div>

                <h2>Recent Adoption Requests</h2>

                <p>Review pending adoption applications.</p>

            </div>

        </div>

        <table>

            <thead>

                <tr>

                    <th>Application ID</th>

                    <th>Applicant</th>

                    <th>Pet</th>

                    <th>Date</th>

                    <th>Status</th>

                    <th width="250">Action</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>1001</td>

                    <td>Juan Dela Cruz</td>

                    <td>Buddy</td>

                    <td>July 1, 2026</td>

                    <td>

                        <span class="badge pending">

                            Pending

                        </span>

                    </td>

                    <td>

                        <a href="approve_application.php?id=1001"
                        class="btn-approve">

                            <i class="fa-solid fa-check"></i>

                            Approve

                        </a>

                        <a href="reject_application.php?id=1001"
                        class="btn-reject">

                            <i class="fa-solid fa-xmark"></i>

                            Reject

                        </a>

                    </td>

                </tr>

                <tr>

                    <td>1002</td>

                    <td>Maria Santos</td>

                    <td>Luna</td>

                    <td>June 30, 2026</td>

                    <td>

                        <span class="badge available">

                            Approved

                        </span>

                    </td>

                    <td>

                        <a href="#"
                        class="btn-view">

                            <i class="fa-solid fa-eye"></i>

                            View

                        </a>

                    </td>

                </tr>

                <tr>

                    <td>1003</td>

                    <td>James Cruz</td>

                    <td>Charlie</td>

                    <td>June 28, 2026</td>

                    <td>

                        <span class="badge adopted">

                            Rejected

                        </span>

                    </td>

                    <td>

                        <a href="#"
                        class="btn-view">

                            <i class="fa-solid fa-eye"></i>

                            View

                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <footer class="footer">

        <p>

            © 2026 Pet Adoption System |
            Admin Dashboard

        </p>

    </footer>

</div>

</body>
</html>
