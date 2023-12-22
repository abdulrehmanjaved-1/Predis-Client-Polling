<?php
session_start();
require("config.php");
require '../vendor/autoload.php';
// require("../predis/predis/autoload.php"); // Adjust the path accordingly


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_POST['btnSubmit'])) {
    // Sanitize and validate your input
    $poll = mysqli_real_escape_string($conn, $_POST["poll"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $answer_options = implode(',', array_map('mysqli_real_escape_string', array_fill(0, count($_POST["answer_options"]), $conn), $_POST["answer_options"]));
    $start_date_time = mysqli_real_escape_string($conn, $_POST["start_date_time"]);
    $end_date_time = mysqli_real_escape_string($conn, $_POST["end_date_time"]);

    $resul=["poll"=>$poll,"description"=>$description,"answer_options"=> $answer_options,"start_date_time"=>$start_date_time,"end_date_time"=>$end_date_time ];
// print_r($resul);
    // Prepare and execute the SQL query
   $query = "INSERT INTO poll (pol, description, answer_options, start_date_time, end_date_time) VALUES ('$poll', '$description', '$answer_options', '$start_date_time', '$end_date_time')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['status'] = "created poll successfully";
        // header("location: index.php");
        // exit(0);
    } else {
        $_SESSION['status'] = "Data not Inserted";
        header("location: createpoll.php");
        // exit(0);
    }
}

// Close the database connection when done
mysqli_close($conn);

 if (isset($result)) {
        // Replace 'your_remote_redis_host' and 'your_remote_redis_port' with the actual remote Redis server details
        $redis = new Predis\Client([
            'scheme' => 'tcp',
            'host'   => 'http://redis-14665.c212.ap-south-1-1.ec2.cloud.redislabs.com', // Remote Redis server host
            'port'   => '14665', // Remote Redis server port
        ]);

        $redis_key = 'sample_post:' . $post_id;

// Optionally, set an expiration time for the Redis key
        $redis->expire($redis_key, 3600); // Expires in 1 hour
$post_data = array(
        'post_title'   => $poll,
        'post_content' => $description,
        'post_status'  => $answer_options,
        'post_author'  => $start_date_time, // Change the author ID as needed
        'post_type'    => $end_date_time,
    );
//   echo   json_encode($post_data);

    //$redis->set($redis_key, json_encode($post_data));

    print_r($post_data);
 
    ?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Create Poll</title>
</head>
<body>
   
    
    <div class="container mt-4">
        <h2 class="text-center mt-4">Create  Poll</h2>
        <form method="post" action=""  id="pollForm">
            <!-- Title -->
            <div class="form-group row">
                <label for="pollTitle" class="col-sm-2 col-form-label">Poll</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pollTitle" name="poll" placeholder="Enter poll">
                    <div id="pollTitleError" class="text-danger"></div> <!-- Error message display -->
                </div>
            </div>

            <!-- Description -->
            <div class="form-group row">
                <label for="pollDescription" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" id="pollDescription" rows="3"
                        placeholder="Enter poll description"></textarea>
                
                        <div id="pollDescriptionError" class="text-danger"></div> <!-- Error message display -->
        
                        
                </div>
            </div>

            <!-- Answer Options -->
            <div class="form-group row" id="optionsContainer">
                <label for="answerOptions" class="col-sm-2 col-form-label " id="">Answer Options</label>
                <div class="col-sm-10">

                    <div class="input-group mb-2" id="option1">
                        <input type="text" class="form-control" name="answer_options[]" multiple="multiple" id=""  placeholder="Enter answer option">

                         <!-- Error message display -->
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary closeBtn" data-optionid="1">Remove</button>
                        </div>

                          <div class="answerOptionError col-md-12 col-sm-12 text-danger"> </div>
                    </div>
                    
                </div>
                <div class="col-sm-2">

                </div>
                 <div class="col-md-10">
                    <button type="button" class="btn btn-primary mt-2 mb-4" id="addOptionBtn" >Add Option</button>
                </div>
            </div>

            <!-- Start Date and Time -->
            <div class="form-group row">
                <label for="startDateTime" class="col-sm-2 col-form-label">Start Date and Time</label>
                <div class="col-sm-10">
                    <div class="input-group date" id="startDateTimePicker" data-target-input="nearest">
                        <input type="datetime-local" class="form-control datetimepicker-input" name="start_date_time"
                            data-target="#startDateTimePicker" id="startDateTime" placeholder="Select date and time" />
                        <div class="input-group-append" data-target="#startDateTimePicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Date and Time -->
            <div class="form-group row">
                <label for="endDateTime" class="col-sm-2 col-form-label">End Date and Time</label>
                <div class="col-sm-10">
                    <div class="input-group date" id="endDateTimePicker" data-target-input="nearest">
                        <input type="datetime-local" class="form-control datetimepicker-input"  name="end_date_time"
                            data-target="#endDateTimePicker" id="endDateTime" placeholder="Select date and time" />
                        <div class="input-group-append" data-target="#endDateTimePicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <input type="submit" name="btnSubmit" value="Submit"> -->

        
            <!-- Buttons -->
            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="btnSubmit" value="Submit" class="btn btn-primary">Save</button>
                </div>
            </div>
           </form>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    
        $(document).ready(function () {
            let optionCounter = 1;

            $('#addOptionBtn').click(function () {
                optionCounter++;
                var optionHtml = `
                
                <div class="col-sm-2">
                </div> 
                
                <div class="input-group mb-2 col-sm-10" id="option${optionCounter}">
                        <input type="text" class="form-control " name="answer_options[]" placeholder="Enter answer option">

                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary closeBtn" data-optionid="${optionCounter}">Remove</button>
                        </div>
                    </div>
                `;
                $('#optionsContainer').append(optionHtml);
            });

            $(document).on('click', '.closeBtn', function () {
                var optionId = $(this).data('optionid');
                $('#option' + optionId).remove();
            });
        });
        <div class="answerOptionError col-md-12 text-danger">

    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to format date and time to fit input[type=datetime-local]
        const formatDateToInputValue = (date) => {
            const year = date.getFullYear();
            let month = (date.getMonth() + 1).toString().padStart(2, '0');
            let day = date.getDate().toString().padStart(2, '0');
            let hours = date.getHours().toString().padStart(2, '0');
            let minutes = date.getMinutes().toString().padStart(2, '0');
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        };

        // Get current date and time in IST
        const nowIST = new Date().toLocaleString('en-US', { timeZone: 'Asia/Kolkata' });
        const currentIST = new Date(nowIST);

        // Set Start Date and Time field with the current IST time
        const startDateTimeField = document.getElementById('startDateTime');
        startDateTimeField.value = formatDateToInputValue(currentIST);

        // Set End Date and Time field with the current IST time plus 30 minutes
        const halfHourAhead = new Date(currentIST.getTime() + (30 * 60 * 1000)); // 30 minutes ahead
        const endDateTimeField = document.getElementById('endDateTime');
        endDateTimeField.value = formatDateToInputValue(halfHourAhead);
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pollForm = document.getElementById('pollForm');
        const pollTitleField = document.getElementById('pollTitle');
        const pollDescriptionField = document.getElementById('pollDescription');
        const errorTitleElement = document.getElementById('pollTitleError');
        const errorDescriptionElement = document.getElementById('pollDescriptionError');

        pollForm.addEventListener('submit', function(event) {
            const pollTitle = pollTitleField.value.trim();
            const pollDescription = pollDescriptionField.value.trim();
            // Clear previous error messages
            errorTitleElement.textContent = '';
            errorDescriptionElement.textContent = '';

            if (pollTitle.length < 10 || pollTitle.length > 250) {
                errorTitleElement.textContent = 'Please enter a valid poll between 10 and 250 characters.';
                event.preventDefault(); // Prevent form submission if validation fails
            }

            if (pollDescription.length < 10 || pollDescription.length > 250) {
                errorDescriptionElement.textContent = 'Please enter a valid Discription between 10 and 250 characters.';
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to validate the form before submission
        function validateForm() {
            let answerOptions = document.getElementsByName('answer_options[]');
            let isValid = true;

            // Loop through each answer option field
            for (let i = 0; i < answerOptions.length; i++) {
                let option = answerOptions[i].value.trim();
                let errorElement = answerOptions[i].parentNode.querySelector('.answerOptionError');

                if (option === '') {
                    errorElement.textContent = 'Answer option is required.';
                    isValid = false;
                } else {
                    errorElement.textContent = '';
                }
            }

            return isValid;
        }

        // Event listener for form submission
        document.getElementById('pollForm').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to validate the form before submission
        function validateForm() {
            let answerOptions = document.getElementsByName('answer_options[]');
            let isValid = true;

            // Loop through each answer option field
            for (let i = 0; i < answerOptions.length; i++) {
                let option = answerOptions[i].value.trim();
                let errorElement = answerOptions[i].parentNode.querySelector('.answerOptionError');

                if (option === '') {
                    errorElement.textContent = 'Answer option is required.';
                    isValid = false;
                } else {
                    errorElement.textContent = '';
                }
            }

            return isValid;
        }

        // Function to add new answer option input field
        function addOption() {
            let optionsContainer = document.getElementById('optionsContainer');
            let newOption = document.createElement('div');
            newOption.className = 'col-md-12';
            newOption.innerHTML = `
            
              <div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="answer_options[]" placeholder="Enter answer option">
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary closeBtn" data-optionid="1">Remove</button>
                </div>
                <div class="answerOptionError col-md-12 text-danger"></div>
            </div>
        </div>
    </div>
</div>

                `;


            optionsContainer.appendChild(newOption);
        }

        // Event listener for "Add Option" button
        document.getElementById('addOptionBtn').addEventListener('click', function() {
            addOption();
        });

        // Event delegation for dynamically added fields
        document.getElementById('pollForm').addEventListener('input', function(event) {
            if (event.target && event.target.matches('input[name="answer_options[]"]')) {
                let option = event.target.value.trim();
                let errorElement = event.target.parentNode.querySelector('.answerOptionError');

                if (option === '') {
                    errorElement.textContent = 'Answer option is required.';
                } else {
                    errorElement.textContent = '';
                }
            }
        });

        // Event listener for form submission
        document.getElementById('pollForm').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
</script>



<script>
    document.getElementById('pollForm').addEventListener('submit', function(event) {
        // Prevent form submission if answer options are less than 2
        var answerOptions = document.getElementsByName('answer_options[]');
        if (answerOptions.length < 2) {
            event.preventDefault(); // Prevent form submission
            // Show an error message or take appropriate action
            alert('Please provide at least two answer options.');
        }
    });
</script>



<script>
    // Function to handle removing an answer option field
    function removeOption(event) {
        event.preventDefault();
        var optionDiv = this.parentNode.parentNode;
        optionDiv.parentNode.removeChild(optionDiv);
    }

    // Add event listeners to all remove buttons
    var removeButtons = document.getElementsByClassName('closeBtn');
    for (var i = 0; i < removeButtons.length; i++) {
        removeButtons[i].addEventListener('click', removeOption);
    }
</script>






<script>
    // Function to handle removing an answer option field
    function removeOption(event) {
        event.preventDefault();
        var optionDiv = this.parentNode.parentNode;
        optionDiv.parentNode.removeChild(optionDiv);
    }

    // Add event listener to the Remove buttons of existing fields
    document.getElementById('optionsContainer').addEventListener('click', function(event) {
        if (event.target.classList.contains('closeBtn')) {
            removeOption.call(event.target, event);
        }
    });

    // Function to add a new answer option field
    document.getElementById('addOptionBtn').addEventListener('click', function() {
        var optionsContainer = document.getElementById('answerOptions');
        var newOptionDiv = document.createElement('div');
        newOptionDiv.classList.add('input-group', 'mb-2');

        var newOptionInput = document.createElement('input');
        newOptionInput.type = 'text';
        newOptionInput.classList.add('form-control');
        newOptionInput.name = 'answer_options[]';
        newOptionInput.placeholder = 'Enter answer option';

        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-secondary', 'closeBtn');
        removeButton.textContent = 'Remove';

        newOptionDiv.appendChild(newOptionInput);
        newOptionDiv.appendChild(removeButton);
        optionsContainer.appendChild(newOptionDiv);
    });
</script>







</body>

</html>

