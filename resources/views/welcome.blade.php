<!-- resources/views/form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Form Submission</title>

    <!-- Add Bootstrap CSS for modal styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <select id="selectOption">
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>

    <form id="myForm">
        @csrf
        <!-- Name input -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <br>

        <!-- Email input -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <br>

        <!-- Your form fields go here -->

        <button type="button" onclick="submitForm()">Submit</button>
    </form>

    <!-- Modal to display selected option value -->
    <div class="modal fade" id="selectedOptionModal" tabindex="-1" role="dialog" aria-labelledby="selectedOptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectedOptionModalLabel">Selected Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="selectedOptionText"></p>
                </div>
            </div>
        </div>
    </div>
    <h1>Hi</h1>

    <div id="responseMessage"></div>

    <!-- Add Bootstrap JS and jQuery for modal functionality -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function submitForm() {
            var formData = $('#myForm').serialize();
            var selectedOption = $('#selectOption').val();

            // Append the selected option value to the serialized form data
            formData += '&selectedOption=' + selectedOption;

            $.ajax({
                url: '/submit-form',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the response from the server
                    $('#responseMessage').html(response);

                    // Display the selected option in the modal
                    $('#selectedOptionText').text('Selected Option: ' + selectedOption);
                    $('#selectedOptionModal').modal('show');
                },
                error: function(xhr) {
                    // Handle any errors that occurred during the request
                    $('#responseMessage').html('Error: ' + xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>
