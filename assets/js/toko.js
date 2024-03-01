// Function to open the Add Customer modal
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

// Function to close the Add Customer modal
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

// Function to confirm the addition of a customer (you can customize this based on your needs)
function confirmAdd() {
    // Add your logic here to handle the form submission and add a new customer
    // You may want to use AJAX to send the form data to the server
    // After adding, close the modal
    closeAddModal();
}

// Function to open the view pop-up
function openViewModal(item) {
    // Get the data from the table row (you may need to customize this based on your table structure)
    var itemName = item.parentNode.parentNode.cells[0].innerText; // Change the index based on the column position
    var itemDescription = item.parentNode.parentNode.cells[1].innerText; // Change the index based on the column position
    var itemAddress = item.parentNode.parentNode.cells[2].innerText; // Change the index based on the column position
    var itemTelephone = item.parentNode.parentNode.cells[3].innerText; // Change the index based on the column position

    // Populate the content in the View Pop-up
    var viewContent = document.getElementById("viewContent");
    viewContent.innerHTML = `
        <p><strong>Nama:</strong> ${itemName}</p>
        <p><strong>Deskripsi:</strong> ${itemDescription}</p>
        <p><strong>Alamat:</strong> ${itemAddress}</p>
        <p><strong>Telephone:</strong> ${itemTelephone}</p>
        <!-- Add more details as needed -->
    `;

    // Display the View Pop-up
    document.getElementById("viewModal").style.display = "flex";
}

// Function to close the view pop-up
function closeViewModal() {
    document.getElementById("viewModal").style.display = "none";
}

// Function to open the edit pop-up
function openEditModal(item) {
    // Get the data from the table row (you may need to customize this based on your table structure)
    var itemName = item.parentNode.parentNode.cells[0].innerText; // Change the index based on the column position
    var itemDescription = item.parentNode.parentNode.cells[1].innerText; // Change the index based on the column position
    var itemAddress = item.parentNode.parentNode.cells[2].innerText; // Change the index based on the column position
    var itemTelephone = item.parentNode.parentNode.cells[3].innerText; // Change the index based on the column position

    // Populate the content in the Edit Pop-up
    var editContent = document.getElementById("editContent");
    editContent.innerHTML = `
        <!-- You can use input fields or other form elements here -->
        <label for="editName">Nama:</label>
        <input type="text" id="editName" value="${itemName}">

        <label for="editDescription">Deskripsi:</label>
        <input type="text" id="editDescription" value="${itemDescription}">

        <label for="editAddress">Alamat:</label>
        <input type="text" id="editAddress" value="${itemAddress}">

        <label for="editTelephone">Telephone:</label>
        <input type="text" id="editTelephone" value="${itemTelephone}">

        <!-- Add more input fields as needed -->
        
    `;

    // Display the Edit Pop-up
    document.getElementById("editModal").style.display = "flex";
}

// Function to confirm the edit action (you can customize this based on your needs)
function confirmEdit() {
    // Get the updated values from the input fields
    var updatedName = document.getElementById("editName").value;
    var updatedDescription = document.getElementById("editDescription").value;
    var updatedAddress = document.getElementById("editAddress").value;
    var updatedTelephone = document.getElementById("editTelephone").value;

    // Add your logic here to handle the edit action
    // You can send the updated values to your server, update the table, etc.

    // For now, let's just close the pop-up
    closeEditModal();
}

// Function to close the edit pop-up
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

// Function to open the delete confirmation pop-up
function openDeleteModal() {
    document.getElementById("deleteModal").style.display = "flex";
}

// Function to close the delete confirmation pop-up
function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

// Function to confirm the delete action (you can customize this based on your needs)
function confirmDelete() {
    // Add your logic here to handle the delete action
    // For now, let's just close the pop-up
    closeDeleteModal();
}