<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">

            <div class="col-2">
                <button id="exam_1" class="btn btn-primary">Exam 1</button>
            </div>
            <div class="col-2">
                <button id="exam_2" class="btn btn-primary">Exam 2</button>
            </div>
            <div class="col-2">
                <button id="exam_3" class="btn btn-primary">Exam 3</button>
            </div>
            <div class="col-2">
                <button id="exam_6" class="btn btn-primary">Exam 6</button>
            </div>

            <!-- form add data -->
            <div class="col-12 mt-4" id="form-add" style="display:none;">
                <h2 class="mb-4">Add New Job</h2>
                <form id="add-job-form">
                    <div class="form-group">
                        <label for="job_id">Job ID</label>
                        <input type="text" class="form-control" id="job_id" name="job_id" placeholder="Enter Job ID"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="job_title">Job Title</label>
                        <input type="text" class="form-control" id="job_title" name="job_title"
                            placeholder="Enter Job Title" required>
                    </div>
                    <div class="form-group">
                        <label for="min_salary">Min Salary</label>
                        <input type="number" class="form-control" id="min_salary" name="min_salary"
                            placeholder="Enter Min Salary" required>
                    </div>
                    <div class="form-group">
                        <label for="max_salary">Max Salary</label>
                        <input type="number" class="form-control" id="max_salary" name="max_salary"
                            placeholder="Enter Max Salary" required>
                    </div>
                    <button type="button" class="btn btn-success" onclick="submitform()">Add Job</button>
                </form>
            </div>

            <div class="col-12 mt-4" id="address">
                <label for="job_id">รหัสไปรษณี</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter Zip Code" required>
                <button type="button" class="btn btn-success mt-3" onclick="searchData()">Add Job</button>
            </div>

            <div class="col-12" id="table">
                <h2 class="mb-4">Jobs List</h2>
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
                    var jobsTable = '';
                    var header = '<tr><th>Job ID</th><th>Job Title</th></tr>';
                    if (response.data.length > 0) {
                        $.each(response.data, function (index, job) {
                            jobsTable += '<tr>';
                            jobsTable += '<td>' + job.job_id + '</td>';
                            jobsTable += '<td>' + job.job_title + '</td>';
                            jobsTable += '</tr>';
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

        function exam_2() {
            $('#form-add').hide(); // Hide form if it's visible
            $('#table').show(); // Show the table
            $('#address').hide();
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
            var job_id = $('#job_id').val();
            var job_title = $('#job_title').val();
            var min_salary = $('#min_salary').val();
            var max_salary = $('#max_salary').val();

            $.ajax({
                url: './api/adddata.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'job_id': job_id,
                    'job_title': job_title,
                    'min_salary': min_salary,
                    'max_salary': max_salary
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

        function searchData(){
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