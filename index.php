<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <button id="exam_1" class="btn btn-primary">Preview Data</button>
            </div>
            <div class="col-6">
                <button id="exam_2" class="btn btn-primary">Add Menu By Shop</button>
            </div>
            <!-- <div class="col-2">
                <button id="exam_3" class="btn btn-primary">Exam 3</button>
            </div>
            <div class="col-2">
                <button id="exam_6" class="btn btn-primary">Exam 6</button>
            </div> -->

            <!-- form add data -->
            <div class="col-12 mt-4" id="form-add" style="display:none;">
                <h2 class="mb-4">Add New Shop</h2>
                <form id="add-job-form">
                    <div class="form-group">
                        <!-- <label for="user_id"> user_id </label>
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter user id"
                            required> -->
                        <label for="job_title">Restaurant Name</label>
                        <input type="text" class="form-control" id="Restaurant_Name" name="Restaurant_Name"
                            placeholder="Enter Restaurant Name" required>

                        <label for="min_salary">Restaurant address</label>
                        <input type="text" class="form-control" id="Restaurant_address" name="Restaurant_address"
                            placeholder="Enter Restaurant address" required>

                        <label for="max_salary">Restaurant phone number</label>
                        <input type="number" class="form-control" id="Restaurant_phone_number"
                            name="Restaurant_phone_number" placeholder="Enter Restaurant phone number" required>
                    </div>
                    <button type="button" class="btn btn-success" onclick="submitform()">Add Restaurant</button>
                </form>
            </div>

            <div class="col-12 mt-4" id="address">
                <label for="job_id">รหัสไปรษณี</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter Zip Code"
                    required>
                <button type="button" class="btn btn-success mt-3" onclick="searchData()">Add Job</button>
            </div>

            <div class="col-12" id="table">
                <h2 class="mb-4">ร้านอาหารทั้งหมด</h2>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark" id="jobs-header">
                        <tr></tr>
                    </thead>
                    <tbody id="jobs-list">
                        <tr></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal  -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Menu Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="container ">
                        <div class="col-6">
                            <button id="exam_2" class="btn btn-primary">Add Menu By Shop</button>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Availability</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <!-- ข้อมูลจะถูกเพิ่มที่นี่ -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            exam_1();
            $('#exam_1').on('click', function () {
                exam_1();
                console.log('exam_1');
            });
            $('#exam_2').on('click', function () {
                exam_2();
                console.log('exam_2');
            });
            $('#exam_3').on('click', function () {
                exam_3();
                console.log('exam_3');
            });

            $('#exam_6').on('click', function () {
                exam_6();
                console.log('exam_6');
            });
        });

        function exam_1() {
            $('#form-add').hide(); // Hide form if it's visible
            $('#table').show(); // Show the table
            $('#address').hide();
            $.ajax({
                url: './api/featch_data.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    'exam': '1'
                },
                success: function (response) {
                    console.log(response);
                    var jobsTable = '';
                    var header = '<tr><th>No.</th><th>Restaurant id</th> <th>Restaurant name</th> <th>Restaurant address </th> <th>Phone Number</th>  <th>Rating</th> <th></th></tr>';
                    let num = 1;
                    if (response.data.length > 0) {
                        $.each(response.data, function (index, res) {
                            jobsTable += '<tr>';
                            jobsTable += '<td>' + num + '</td>';
                            jobsTable += '<td>' + res.restaurant_id + '</td>';
                            jobsTable += '<td>' + res.name + '</td>';
                            jobsTable += '<td>' + res.address + '</td>';
                            jobsTable += '<td>' + res.phone_number + '</td>';
                            jobsTable += '<td>' + res.rating + '</td>';
                            jobsTable += '<td><button class="btn btn-success" onclick="viewMenu(' + res.restaurant_id + ')">Delete</button> <button class="btn btn-danger" onclick="deleteJob(' + res.restaurant_id + ')">Delete</button></td>';
                            jobsTable += '</tr>';

                            num += 1;
                        });
                    } else {
                        jobsTable = '<tr><td colspan="2" class="text-center">No jobs found</td></tr>';
                    }
                    $('#jobs-header').html(header);
                    $('#jobs-list').html(jobsTable);
                },
                error: function () {
                    $('#jobs-list').html('<tr><td colspan="2" class="text-center">Failed to load jobs</td></tr>');
                }
            });
        }

        function viewMenu(id) {
            $('#myModal').modal('show');
            $.ajax({
                url: './api/featch_data.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    'exam': 'view_menu',
                    'id': id
                },
                success: function (response) {
                    const data = response.data;
                    $('#table-body').empty();
                    if (data.length === 0) {
                        const row = `
                    <tr>
                        <td colspan="8" style="text-align: center; color: red;"><b>ไม่พบข้อมูล</b></td>
                        </tr>
                        `;
                        $('#table-body').append(row);
                    } else {
                        data.forEach(item => {
                            const row = `
                    <tr>
                        <td>${item.item_id}</td>
                        <td>${item.name}</td>
                        <td>${item.description}</td>
                        <td>${item.price}</td>
                        <td>${item.availability}</td>
                        <td>${item.category}</td>
                        <td>${item.created_at}</td>
                    </tr>
                `;
                            // เพิ่มแถวใหม่ลงในตาราง
                            $('#table-body').append(row);
                        });
                    }
                    // เคลียร์ข้อมูลเก่าที่มีในตารางก่อน


                    // วนลูปผ่านอาร์เรย์และสร้างแถวสำหรับแต่ละรายการ

                },
                error: function () {
                    alert('Error fetching data.');
                }
            });
        }


        function deleteJob(id) {
            console.log(id)
        }

        function exam_2() {
            $('#form-add').show(); // Hide form if it's visible
            $('#table').hide(); // Show the table
            // $('#address').hide();
            $.ajax({
                url: './api/featch_data.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    'exam': '2'
                },
                success: function (response) {
                    var jobsTable = '';
                    var header = '<tr><th>First Name</th><th>Last Name</th><th>Department</th></tr>';
                    if (response.data.length > 0) {
                        $.each(response.data, function (index, job) {
                            jobsTable += '<tr>';
                            jobsTable += '<td>' + job.first_name + '</td>';
                            jobsTable += '<td>' + job.last_name + '</td>';
                            jobsTable += '<td>' + job.department_name + '</td>';
                            jobsTable += '</tr>';
                        });
                    } else {
                        jobsTable = '<tr><td colspan="3" class="text-center">No jobs found</td></tr>';
                    }
                    $('#jobs-header').html(header);
                    $('#jobs-list').html(jobsTable);
                },
                error: function () {
                    $('#jobs-list').html('<tr><td colspan="3" class="text-center">Failed to load jobs</td></tr>');
                }
            });
        }

        function exam_3() {
            $('#table').hide(); // Hide the table
            $('#form-add').show(); // Show the form
            $('#address').hide();
        }

        function exam_6() {
            $('#table').hide(); // Hide the table
            $('#form-add').hide(); // Show the form
            $('#address').show(); // Show the form
        }

        function submitform() {
            // var user_id = $('#user_id').val();
            var Restaurant_Name = $('#Restaurant_Name').val();
            var Restaurant_address = $('#Restaurant_address').val();
            var Restaurant_phone_number = $('#Restaurant_phone_number').val();

            $.ajax({
                url: './api/adddata.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    // 'user_id': user_id,
                    'Restaurant_Name': Restaurant_Name,
                    'Restaurant_address': Restaurant_address,
                    'Restaurant_phone_number': Restaurant_phone_number
                },
                success: function (response) {
                    console.log(response);
                    if (response.status) {
                        Swal.fire({
                            title: "เพิ่มข้อมูลสำเร็จ!",
                            text: "กดปุ่มเพื่อปิด!",
                            icon: "success"
                        });
                        $('#add-job-form')[0].reset();
                    } else {
                        alert('Failed to insert data');
                    }
                },
                error: function () {
                    alert('Failed to insert data');
                }
            });
        }

        function searchData() {
            var zip_code = $('#zip_code').val();
            $('#table').show();
            $.ajax({
                url: './api/featch_data.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    'exam': '6',
                    'zip_code': zip_code
                },
                success: function (response) {
                    var jobsTable = '';
                    var header = '<tr><th>city </th><th>country_name</th><th>postal_code</th> <th>region_name</th></tr>';
                    if (response.data.length > 0) {
                        $.each(response.data, function (index, job) {
                            jobsTable += '<tr>';
                            jobsTable += '<td>' + job.city + '</td>';
                            jobsTable += '<td>' + job.country_name + '</td>';
                            jobsTable += '<td>' + job.postal_code + '</td>';
                            jobsTable += '<td>' + job.region_name + '</td>';
                            jobsTable += '</tr>';
                        });
                    } else {
                        jobsTable = '<tr><td colspan="3" class="text-center">No jobs found</td></tr>';
                    }
                    $('#jobs-header').html(header);
                    $('#jobs-list').html(jobsTable);

                },
                error: function () {
                    $('#jobs-list').html('<tr><td colspan="3" class="text-center">Failed to load jobs</td></tr>');
                }
            });
        }


    </script>

</body>

</html>