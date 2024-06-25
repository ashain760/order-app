<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration | Indexed DB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">

        <h1 class="text-center">
            User Registration <br />
            <small style="font-size: 18px;">(Indexed DB)</small>
        </h1>

        <div class=" d-flex justify-content-center">
            <form id="dataForm" class="mb-4 mt-3 user-form shadow rounded-3">
                <input type="hidden" id="recordId">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="number" class="form-control" id="contact" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <button type="submit" id="submitBtn" class="btn btn-dark float-end"> &nbsp; SUBMIT &nbsp; </button>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="data-table shadow mb-5">
            <table class="table" id="dataTable" width="100%">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
