<?php
  include('partials\header.php');
  include('partials\sidebar.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Student Information System</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">General</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h5 class="card-title">Student Table</h5>
              </div>
              <div>
                <!-- Add Student Button -->
                <button class="btn btn-primary btn-sm mt-4 mx-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
              </div>
            </div>

            <!-- Search Bar in Header -->
            <div class="mb-3">
              <input type="text" class="form-control" id="searchInput" placeholder="Search students by Name, Course, Age or Address">
            </div>

            <!-- Student Table -->
            <table class="table" id="studentTable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Age</th>
                  <th scope="col">Address</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="studentTableBody">
                <!-- Static Student Row Example (this will be replaced dynamically) -->
                <tr>
                  <th scope="row">1</th>
                  <td>Brandon Jacob</td>
                  <td>BSIT</td>
                  <td>20</td>
                  <td>San Vicente, Bulan, Sorsogon</td>
                  <td class="d-flex justify-content-center">
                    <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editInfo" onclick="openEditModal(this)">Edit</button>
                    <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#viewInfo" onclick="openViewModal(this)">View</button>
                    <button class="btn btn-danger btn-sm mx-1" onclick="confirmDeleteStudent(this)">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- End Student Table -->

          </div>
        </div>
      </div>
    </div>

    <!-- Add Student Modal (Unchanged) -->
    <div class="modal fade" id="addStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addStudentModalLabel">Add New Student</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addStudentForm">
              <div class="mb-3">
                <label for="studentName" class="form-label">Name</label>
                <input type="text" class="form-control" id="studentName" required>
              </div>
              <div class="mb-3">
                <label for="studentCourse" class="form-label">Course</label>
                <input type="text" class="form-control" id="studentCourse" required>
              </div>
              <div class="mb-3">
                <label for="studentAge" class="form-label">Age</label>
                <input type="number" class="form-control" id="studentAge" required>
              </div>
              <div class="mb-3">
                <label for="studentAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="studentAddress" required>
              </div>
              <button type="submit" class="btn btn-primary">Save Student</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- View Student Modal (Fixed View Button) -->
    <div class="modal fade" id="viewInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewInfoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewInfoLabel">Student Information</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="viewStudentDetails">
            <!-- Student details will be shown here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Student Modal (Unchanged) -->
    <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editInfoLabel">Edit Student Information</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editStudentForm">
              <div class="mb-3">
                <label for="editStudentName" class="form-label">Name</label>
                <input type="text" class="form-control" id="editStudentName" required>
              </div>
              <div class="mb-3">
                <label for="editStudentCourse" class="form-label">Course</label>
                <input type="text" class="form-control" id="editStudentCourse" required>
              </div>
              <div class="mb-3">
                <label for="editStudentAge" class="form-label">Age</label>
                <input type="number" class="form-control" id="editStudentAge" required>
              </div>
              <div class="mb-3">
                <label for="editStudentAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="editStudentAddress" required>
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
</main><!-- End #main -->

<?php
include('partials\footer.php');
?>

<!-- JavaScript to handle Add Student functionality, View Button, Edit Button, and Search -->
<script>
  // Add Student Function
  document.getElementById('addStudentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get input values
    var name = document.getElementById('studentName').value;
    var course = document.getElementById('studentCourse').value;
    var age = document.getElementById('studentAge').value;
    var address = document.getElementById('studentAddress').value;

    // Get the table body element
    var tableBody = document.getElementById('studentTableBody');

    // Get the next row number
    var rowCount = tableBody.rows.length + 1;

    // Create new row and add data
    var newRow = tableBody.insertRow(tableBody.rows.length);
    newRow.innerHTML = `
      <th scope="row">${rowCount}</th>
      <td>${name}</td>
      <td>${course}</td>
      <td>${age}</td>
      <td>${address}</td>
      <td class="d-flex justify-content-center">
        <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editInfo" onclick="openEditModal(this)">Edit</button>
        <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#viewInfo" onclick="openViewModal(this)">View</button>
        <button class="btn btn-danger btn-sm mx-1" onclick="confirmDeleteStudent(this)">Delete</button>
      </td>
    `;

    // Close the modal
    var modal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
    modal.hide();

    // Clear the form fields
    document.getElementById('addStudentForm').reset();
  });

  // Confirm Delete Function
  function confirmDeleteStudent(button) {
    if (confirm("Are you sure you want to delete this information?")) {
      // Find the row of the delete button and remove it
      var row = button.closest('tr');
      row.remove();
    }
  }

  // Open View Modal and Populate Data (This is what was missing)
  function openViewModal(button) {
    var row = button.closest('tr');
    var name = row.cells[1].textContent;
    var course = row.cells[2].textContent;
    var age = row.cells[3].textContent;
    var address = row.cells[4].textContent;

    // Populate the View Modal with the student's details
    document.getElementById('viewStudentDetails').innerHTML = `
      <p><strong>Name:</strong> ${name}</p>
      <p><strong>Course:</strong> ${course}</p>
      <p><strong>Age:</strong> ${age}</p>
      <p><strong>Address:</strong> ${address}</p>
    `;
  }

  // Open Edit Modal and Populate Data
  function openEditModal(button) {
    var row = button.closest('tr');
    var name = row.cells[1].textContent;
    var course = row.cells[2].textContent;
    var age = row.cells[3].textContent;
    var address = row.cells[4].textContent;

    // Populate the Edit Modal with the student's details
    document.getElementById('editStudentName').value = name;
    document.getElementById('editStudentCourse').value = course;
    document.getElementById('editStudentAge').value = age;
    document.getElementById('editStudentAddress').value = address;

    // Handle saving changes
    document.getElementById('editStudentForm').onsubmit = function(event) {
      event.preventDefault();

      // Update row with the new data
      row.cells[1].textContent = document.getElementById('editStudentName').value;
      row.cells[2].textContent = document.getElementById('editStudentCourse').value;
      row.cells[3].textContent = document.getElementById('editStudentAge').value;
      row.cells[4].textContent = document.getElementById('editStudentAddress').value;

      // Close the modal
      var modal = bootstrap.Modal.getInstance(document.getElementById('editInfo'));
      modal.hide();
    };
  }

  // Search Function (Triggered by search bar in header)
  document.getElementById('searchInput').addEventListener('keyup', function() {
    var query = this.value.toLowerCase();
    var rows = document.getElementById('studentTableBody').getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
      var row = rows[i];
      var cells = row.getElementsByTagName('td');
      var found = false;
      
      // Loop through the table cells (excluding the action button cell)
      for (var j = 0; j < cells.length - 1; j++) {
        var cell = cells[j];
        if (cell.textContent.toLowerCase().includes(query)) {
          found = true;
          break;
        }
      }

      // Show or hide rows based on the search match
      row.style.display = found ? '' : 'none';
    }
  });
</script>
