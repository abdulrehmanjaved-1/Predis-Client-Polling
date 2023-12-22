<?php
session_start();
require("config.php");
//echo $_GET["uid"];
$id = $_GET["uid"];





$resultset = mysqli_query($conn, "SELECT * FROM poll WHERE id = '$id'");
$data = mysqli_fetch_assoc($resultset);

if (!$data) {
    echo "No data found for the given ID.";
    exit;
}

// Parse answer options
$string = $data['answer_options'];
$array = explode(',', $string);



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Poll Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">

    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>

    <div class="container shadow p-3 mt-1 bg-white rounded">
    <?php
if(isset($_SESSION['status']))
{
    ?>
    <h4 class="alert alert-success"><?php echo $_SESSION['status']?></h4>
    <?php
    unset($_SESSION['status']);
}

    ?>
        <h2>Poll</h2>
        <form id="editPollForm" method="post">
            <div class="form-group mt-4" >
                <label for="pollID"> Title</label>
                
                <input type="text" class="form-control" name="pol" id="pollID" value="<?php echo $data['pol']?>" placeholder="Parent Communication Survey">
                <small class="form-text text-muted">Enter the ID of the poll you want to edit.</small>
            </div>
            <div class="form-group">
                <label for="editedQuestion"> Description:</label>
                <input type="text" class="form-control" name="description" id="editedQuestion" value="<?php echo $data['description']?>"  placeholder="Incident Documentation Form">
            </div>
           


          
              <!-- Answer Options -->
              <div class="form-group row" id="optionsContainer">
              
           <?php foreach ($array as $option) { 

       //     echo "$option";
            ?>
            
                    <div class="col-sm-12">
                        <label for="answerOptions" class="col-sm-2 col-form-label">Answer Options</label>
                        <div class="input-group mb-2" id="option1">
                            
                            <input type="text" class="form-control"   name="answer_options[]" multiple="multiple" value="<?php echo $option ?>" placeholder="Enter answer option">
                            
                            <div class="input-group-append">
                                <button type="button" class="btn btn-secondary closeBtn" data-optionid="1">Remove</button>
                            </div>
                        </div>
                    </div>
                    
                <?php } ?>
                </div>
                
                <!--<div class="col-sm-2"></div>-->
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary mb-2" id="addOptionBtn">Add Option</button>
                </div>
                
                
                
                  <div class="form-group">
                <label for="editedExpiryDate">Start Date and Time:</label>
                <input type="datetime-local" class="form-control" name="start_date_time" value="<?php echo $data['start_date_time']?>" id="editedExpiryDate" >
            </div>
            
            
            
             <div class="form-group">
                <label for="editedExpiryDate">End Date and Time:</label>
                <input type="datetime-local" class="form-control" name="end_date_time" value="<?php echo $data['end_date_time']?>" id="editedExpiryDate"  >
            </div>
            
            
               <button type="submit" name="btnUpdate" class="btn btn-info mb-3" value="Update" >Update</button>
            </div>

            <!-- <div class="form-group">
                <label for="editedImageURL">Edited Image URL:</label>
                <input type="text" class="form-control" id="editedImageURL">
            </div> -->
            <!-- <div class="form-group">
                <label for="allowMultipleChoices">Allow Multiple Choices:</label>
                <input type="checkbox" id="allowMultipleChoices">
            </div> -->


          
          
             
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    

    <!-- Custom JavaScript for handling poll editing -->
    <script>
        function editPoll() {
            // Get form values
            const pollID = document.getElementById('pollID').value;
            const editedQuestion = document.getElementById('editedQuestion').value;
            const editedDescription = document.getElementById('editedDescription').value;
            const editedOptions = document.getElementById('editedOptions').value.split(',').map(option => option.trim());
            const editedImageURL = document.getElementById('editedImageURL').value;
            const allowMultipleChoices = document.getElementById('allowMultipleChoices').checked;
            const editedExpiryDate = new Date(document.getElementById('editedExpiryDate').value);

            // TODO: Send the edited poll data to your server for processing (e.g., update in CMS database)
            updatePollInCMS(pollID, editedQuestion, editedDescription, editedOptions, editedImageURL, allowMultipleChoices, editedExpiryDate);

            // Set up a timer for automatic closure of the edited poll
            const currentTime = new Date().getTime();
            const timeDifference = editedExpiryDate - currentTime;

            setTimeout(() => {
                // TODO: Implement code to close the edited poll and display final results
                alert('Edited Poll closed! Display final results here.');
            }, timeDifference);

            // TODO: Update the poll in Redis (SortedSet for list and JSON for poll details)
            updatePollInRedis(pollID, editedQuestion, editedOptions, editedExpiryDate);

            alert('Poll edited successfully!');
        }

        function updatePollInCMS(pollID, question, description, options, imageURL, allowMultipleChoices, expiryDate) {
            // TODO: Implement the logic to update the poll in the CMS database
            // Example: cmsDatabase.updatePoll(pollID, question, description, options, imageURL, allowMultipleChoices, expiryDate);
        }

        function updatePollInRedis(pollID, question, options, expiryDate) {
            // TODO: Implement the logic to update the poll in Redis
            // Example: redisClient.zadd('active_polls', expiryDate.getTime(), pollID);
            // Example: redisClient.hset('poll_details', pollID, JSON.stringify({ question, options, expiryDate }));
        }
    </script>
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.getElementById('editPollForm').addEventListener('submit', function(event) {
        const titleInput = document.getElementById('pollID');
        const title = titleInput.value.trim();

        if (title.length < 10 || title.length > 250) {
            event.preventDefault(); // Prevent form submission if validation fails

            // Display an error message indicating the character limit requirement
            const errorElement = document.createElement('div');
            errorElement.classList.add('text-danger');
            errorElement.textContent = 'Title should be between 10 and 250 characters.';
            
            // Check if error message already exists, if not, append it after the title input
            if (!titleInput.parentNode.querySelector('.text-danger')) {
                titleInput.parentNode.appendChild(errorElement);
            }
        }
    });
</script>


<script>
    document.getElementById('editPollForm').addEventListener('submit', function(event) {
        const descriptionInput = document.getElementById('editedQuestion');
        const description = descriptionInput.value.trim();

        // Validate Description
        if (description.length < 10 || description.length > 250) {
            event.preventDefault(); // Prevent form submission if validation fails

            // Display an error message indicating the character limit requirement
            const errorElement = document.createElement('div');
            errorElement.classList.add('text-danger');
            errorElement.textContent = 'Description should be between 10 and 250 characters.';
            
            // Check if error message already exists, if not, append it after the description input
            if (!descriptionInput.parentNode.querySelector('.text-danger')) {
                descriptionInput.parentNode.appendChild(errorElement);
            }
        }
    });
</script>












<!-- Custom JavaScript for handling poll editing -->
<script>
    $(document).ready(function() {
        var optionCounter = <?php echo count($array); ?>; // Set the initial counter to the number of existing options

        $('#addOptionBtn').click(function() {
            var optionHtml = `
                <div class="col-sm-12">
                    <label for="answerOptions" class="col-sm-2 col-form-label"></label>
                    <div class="input-group mb-2" id="option${optionCounter + 1}">
                        <input type="text" class="form-control" name="answer_options[]" placeholder="Enter answer option">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary closeBtn" data-optionid="${optionCounter + 1}">Remove</button>
                        </div>
                    </div>
                </div>
            `;
            $('#optionsContainer').append(optionHtml);
            optionCounter++; // Increment the counter for the new option
        });

        $(document).on('click', '.closeBtn', function() {
            var optionId = $(this).data('optionid');
            $('#option' + optionId).remove();
        });

        $('#editPollForm').submit(function(event) {
            // Count the number of non-empty answer option fields
            var answerOptionInputs = $('#optionsContainer input[type="text"]').filter(function() {
                return this.value.trim() !== '';
            });

            // Validate number of answer options
            if (answerOptionInputs.length < 2) {
                event.preventDefault(); // Prevent form submission if validation fails

                // Display an alert informing the user about the requirement for at least two answer options
                alert('Please add at least two answer options.');
            }
        });
    });
</script>






</body>

</html>
<div class="row">
    <div class="col-md-12">
        
    </div>
</div>
<?php
session_start();
// update code 
if (!empty($_POST["btnUpdate"])) {

    $poll = $_POST["pol"];
    $description = $_POST["description"];
    $start_date_time = $_POST["start_date_time"];
    $end_date_time = $_POST["end_date_time"];
    //echo $description;
    //echo $_POST["answer_options[]"];
    $answer_options = implode(',', array_map('mysqli_real_escape_string', array_fill(0, count($_POST["answer_options"]), $conn),
     $_POST["answer_options"]));
   //  echo   $answer_options;

    $query = "UPDATE poll SET pol = '$poll' ,answer_options='$answer_options', description = '$description', start_date_time = '$start_date_time', end_date_time = '$end_date_time'
     WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
            if($result)

//echo $result;
{
              echo "<script>alert('Poll Updated Successfully'); window.location = 'index.php';</script>";
}

}
?>