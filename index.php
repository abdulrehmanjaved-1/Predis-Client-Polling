
<?php
require("config.php");
require './vendor/autoload.php';


session_start();
if(isset($_SESSION['status']))
{
    ?>
    <h4 class="alert alert-success"><?php echo $_SESSION['status']?></h4>
    <?php
    unset($_SESSION['status']);
}
if(isset($_SESSION['deleted']))
{
    ?>
    <h4 class="alert alert-danger"><?php echo $_SESSION['deleted']?></h4>
    <?php
    unset($_SESSION['deleted']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font Osame -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/7d08567bd4.css" crossorigin="anonymous">

    <style>
        body {
            background-color: rgb(236, 236, 236);
        }

        .container-fluid {
            background-color: white;
            border-radius: 2%;
        }


        /* table */
        body {
            background-color: #eff3f7;
        }

        .container-fluid {

            border-radius: 2%;
            /* margin: 2rem; */
        }

        .span1 {
            background-color: #f7e6e6;
            border-radius: 5%;
            color: red;
            padding: 5px;

        }

        .span2 {
            background-color: #c7dce4;
            border-radius: 5%;
            color: rgb(26, 151, 209);
            padding: 5px;

        }

        .IMG1 {
            height: 5vh;

        }

        .IMG2 {
            height: 8vh;
            width: 10vw;
            /* icon action   */
        }

        .prant_div {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .cut_line {

            height: 35px;
            width: 6px;


        }

        .add_icon {
            height: 30px;
            width: 30px;
            background-color: #704d7c;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .add_icon i {
            color: #FFF;
        }

        .delete_icon {
            height: 30px;
            width: 30px;
            background-color: #ff3a6e;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .delete_icon i {
            color: #FFF;
        }

        .edit_icon {
            height: 30px;
            width: 30px;
            background-color: #70d843;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit_icon i {
            color: #FFF;
        }

        .parent_div {
            display: flex;
            gap: 10px;
        }

        .view_icon {
            height: 30px;
            width: 30px;
            background-color: #ffa21d;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .view_icon i {
            color: #FFF;
        }

        .print_icon {
            height: 30px;
            width: 30px;
            background-color: #10c2a7;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .print_icon i {
            color: #FFF;
        }



        /* toggle */
        @supports(-webkit-appearance: none) or (-moz-appearance: none) {

            input[type='checkbox'],
            input[type='radio'] {
                --active: #70d843;
                --active-inner: #fff;
                --focus: 2px rgba(39, 94, 254, .3);
                --border: #BBC1E1;
                --border-hover: #275EFE;
                --background: #fff;
                --disabled: #F6F8FF;
                --disabled-inner: #E1E6F9;
                -webkit-appearance: none;
                -moz-appearance: none;
                height: 21px;
                outline: none;
                display: inline-block;
                vertical-align: top;
                position: relative;
                margin: 0;
                cursor: pointer;
                border: 1px solid var(--bc, var(--border));
                background: var(--b, var(--background));
                transition: background .3s, border-color .3s, box-shadow .2s;

                &:after {
                    content: '';
                    display: block;
                    left: 0;
                    top: 0;
                    position: absolute;
                    transition: transform var(--d-t, .3s) var(--d-t-e, ease), opacity var(--d-o, .2s);
                }

                &:checked {
                    --b: var(--active);
                    --bc: var(--active);
                    --d-o: .3s;
                    --d-t: .6s;
                    --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
                }

                &:disabled {
                    --b: var(--disabled);
                    cursor: not-allowed;
                    opacity: .9;

                    &:checked {
                        --b: var(--disabled-inner);
                        --bc: var(--border);
                    }

                    &+label {
                        cursor: not-allowed;
                    }
                }

                &:hover {
                    &:not(:checked) {
                        &:not(:disabled) {
                            --bc: var(--border-hover);
                        }
                    }
                }

                &:focus {
                    box-shadow: 0 0 0 var(--focus);
                }

                &:not(.switch) {
                    width: 21px;

                    &:after {
                        opacity: var(--o, 0);
                    }

                    &:checked {
                        --o: 1;
                    }
                }

                &+label {
                    font-size: 14px;
                    line-height: 21px;
                    display: inline-block;
                    vertical-align: top;
                    cursor: pointer;
                    margin-left: 4px;
                }
            }

            input[type='checkbox'] {
                &:not(.switch) {
                    border-radius: 7px;

                    &:after {
                        width: 5px;
                        height: 9px;
                        border: 2px solid var(--active-inner);
                        border-top: 0;
                        border-left: 0;
                        left: 7px;
                        top: 4px;
                        transform: rotate(var(--r, 20deg));
                    }

                    &:checked {
                        --r: 43deg;
                    }
                }

                &.switch {
                    width: 38px;
                    border-radius: 11px;

                    &:after {
                        left: 2px;
                        top: 2px;
                        border-radius: 50%;
                        width: 15px;
                        height: 15px;
                        background: var(--ab, var(--border));
                        transform: translateX(var(--x, 0));
                    }

                    &:checked {
                        --ab: var(--active-inner);
                        --x: 17px;
                    }

                    &:disabled {
                        &:not(:checked) {
                            &:after {
                                opacity: .6;
                            }
                        }
                    }
                }
            }

            input[type='radio'] {
                border-radius: 50%;

                &:after {
                    width: 19px;
                    height: 19px;
                    border-radius: 50%;
                    background: var(--active-inner);
                    opacity: 0;
                    transform: scale(var(--s, .7));
                }

                &:checked {
                    --s: .5;
                }
            }
        }

        Demo ul {
            margin: 12px;
            padding: 0;
            list-style: none;
            width: 100%;
            max-width: 320px;

            li {
                margin: 16px 0;
                position: relative;
            }
        }

        html {
            box-sizing: border-box;
        }

        * {
            box-sizing: inherit;

            &:before,
            &:after {
                box-sizing: inherit;
            }
        }

        Center & dribbble body {
            min-height: 100vh;
            font-family: 'Inter', Arial, sans-serif;
            color: #8A91B4;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #F6F8FF;

            @media(max-width: 800px) {
                flex-direction: column;
            }
        }

        /* table */

        .card {
            padding: .5rem;
        }

        .text-decoration {

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .returnimage {
            width: 50px;
            height: 45px;
        }



        .btn-Create {
            background-color: #dedcf6;
            padding: 9px 15px;
            border: none;
            color: #51459d;
            border-radius: 8px;
            /* font-weight: 500; */
        }

        .btn-Create:hover {
            background-color: #584ED2;
            color: #dedcf6;
            transition: 0.3s;
        }

        .btn-Create1 {
            background-color: #e2e3e5;
            padding: 9px 15px;
            border: none;
            color: #293240;
            border-radius: 8px;
            /* font-weight: 500; */
        }

        .btn-Create1:hover {
            background-color: gray;
            color: #dedcf6;
            transition: 0.3s;
        }

        .btn-Create2 {
            background-color: rgb(250, 204, 208);
            padding: 9px 15px;
            border: none;
            color: #dc3545;
            border-radius: 8px;
            /* font-weight: 500; */
        }

        .btn-Create2:hover {
            background-color: #dc3545;
            color: #dedcf6;
            transition: 0.3s;
        }

        .btn-Create3 {
            background-color: #fffed5;
            padding: 9px 15px;
            border: none;
            color: #ffc107;
            border-radius: 8px;
            /* font-weight: 500; */
        }

        .btn-Create3:hover {
            background-color: #ffc107;
            color: #dedcf6;
            transition: 0.3s;
        }

        .circle {
            width: 100px;
            height: 100px;
            border: 4px solid rgb(235, 235, 63);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background-color: white;
        }

        .exclamation {

            font-size: 70px;
            font-weight: normal;
        }
    </style>
</head>

<body>


    <div class="container-fluid">
  
        <div class="row">
            <div class="col-lg-12 mt-2">
                <h3 class="mx-4">
                    Poll
                </h3>
            </div>
        </div>
        <div class="shadow p-4 bg-body rounded  mt-2"
            style=" margin-bottom: 3rem;  padding-bottom: 2rem; overflow: auto;">
            <div class="row mb-4 d-flex">
               
                <div class="col-md-6 ">
                    <a href="createpoll.php" style="text-decoration: none;">
                        <button type="button" class="btn btn-Create"> <i class="fa-solid fa-plus "
                                style="color:#b2b1b9;"></i>
                            Create</button>
                    </a>
                    <!-- <div class="btn-group">
                        <button type="button" class="btn btn-Create1  btn-Create1  dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">Export</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item " href="#" style="color: #584ED2;"> <i class="fa-solid fa-print"
                                        style="color: #584ED2;"> </i> Print</a></li>
                            <li>
                                <a class="dropdown-item" href="csv.html" style="color: #584ED2;">
                                    <i class="fa-solid fa-file-csv" style="color:#584ED2;"></i>
                                    CSV
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="#" style="color: #584ED2;"> <i
                                        class="fa-solid fa-file-excel" style="color:#584ED2;"></i> Excel</a></li>
                        </ul>
                    </div> -->
                    <!-- <button type="button" class="btn Create2 px-4 btn-Create2">Reset</button>
                    <button type="button" class="btn Create3 px-4 btn-Create3">Reload</button> -->
                </div>
                <div class="col-md-6 ">
                    <div class="d-md-flex justify-content-end">
                        <input class="form-control me-5 w-50" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </div>
            </div>
            <?php 
    require("config.php");
    $resultset = mysqli_query($conn, "SELECT * FROM poll");
?>

            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead class=" ">
                        
                        <tr class="table-light">
                            <th scope="col" style="text-align:start;">No</th>

                            <th scope="col " style="text-align: start;">  Title</th>

                            <th scope="col" style="text-align:start;"> Description</th>
                            <th scope="col" style="text-align:start;">End Time</th>
                            <th scope="col"
                                style="text-align: strat; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                              Create At</th>
                            <th scope="col" class="text-start">Actions</th>

                        </tr>

                    </thead>
                    <tbody>
                    <?php 
        while($data = mysqli_fetch_assoc($resultset))
        {
    ?>
                        <tr class="text-decoration  text-start">

                            <td>
                            <?php echo $data['id']?>
                            </td>
                            <td>
                            <?php echo $data['pol']?>
                            </td>

                            <td><?php echo $data['description']?></td>
                            <td><?php echo $data['start_date_time']?></td>

                            <td><?php echo $data['start_date_time']?></td>

                            <td>
                                <div class="parent_div ">

                                    <!-- <div style="cursor: pointer;" class="add_icon"
                                        aria-label="Example icon button with a menu icon">
                                        <i class="fa-solid fa-copy" style="color: #fcfcfc;"></i>
                                    </div> -->

                                     <div style="cursor: pointer;" class="print_icon"
                                        aria-label="Example icon button with a menu icon">
                                        <a href="showpoll.php" style="text-decoration: none;">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    </div> 
                                    
                                    <!-- <div style="cursor: pointer;" class="view_icon"
                                        aria-label="Example icon button with a menu icon">
                                        <i class="fa-solid fa-copy" style="color: #fcfcfc;"></i>
                                    </div> -->

                                    <div style="cursor: pointer;" class="edit_icon"
                                        aria-label="Example icon button with a menu icon">
                                        <a href="editingpoll.php?uid=<?php echo $data['id']?>" style="text-decoration: none;"> <i
                                                class="ri-pencil-line"></i>
                                        </a>
                                    </div>


                                    <div style="cursor: pointer;" class="delete_icon" data-bs-toggle=""
                                        data-bs-target=""
                                        aria-label="Example icon button with a menu icon"><a href="delete.php?uid=<?php echo $data['id']?>"><i class="ri-delete-bin-6-line "></i></a>
                                        
                                    </div>

                                </div>



                            </td>
                        </tr>
                        <?php } ?> 

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
         
        </div> -->
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="row">
                                            <div class="text-center">
                                                <i class="fa-sharp fa-regular fa-circle-exclamation exclamation  "
                                                    style="color: #cfa120;"></i>
                                            </div>
                                            <div class="col-md-12 text-center mt-1">
                                                <h3>Are you sure?</h3>
                                            </div>
                                            <div class="mt-2">
                                                <p>This action can not be undone. Do you want to continue?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-warning">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
         
        </div> -->
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="row">
                                            <div class="text-center">
                                                <i class="fa-sharp fa-regular fa-circle-exclamation exclamation  "
                                                    style="color: #cfa120;"></i>
                                            </div>
                                            <div class="col-md-12 text-center mt-1">
                                                <h3>Are you sure?</h3>
                                            </div>
                                            <div class="mt-2">
                                                <p>This action can not be undone. Do you want to continue?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-warning">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                      

                        

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
         
        </div> -->
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="row">
                                            <div class="text-center">
                                                <i class="fa-sharp fa-regular fa-circle-exclamation exclamation  "
                                                    style="color: #cfa120;"></i>
                                            </div>
                                            <div class="col-md-12 text-center mt-1">
                                                <h3>Are you sure?</h3>
                                            </div>
                                            <div class="mt-2">
                                                <p>This action can not be undone. Do you want to continue?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-warning">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                       

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel5"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
         
        </div> -->
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="row">
                                            <div class="text-center">
                                                <i class="fa-sharp fa-regular fa-circle-exclamation exclamation  "
                                                    style="color: #cfa120;"></i>
                                            </div>
                                            <div class="col-md-12 text-center mt-1">
                                                <h3>Are you sure?</h3>
                                            </div>
                                            <div class="mt-2">
                                                <p>This action can not be undone. Do you want to continue?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-warning">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="row mx-auto">
                <div class=" col-md-11 d-flex justify-content-end">
                    <p class="mt-1"> <b>Entries Per Page</b>
                    </p>
                </div> 
                <div class="col-md-1 d-flex justify-content-end">
                    
                    <select class="form-select w-100  text-end" aria-label="Default select example">
                        <option selected>10</option>
                        <option value="1">10</option>
                        <option value="2">25</option>
                        <option value="3">50</option>
                        <option value="3">100</option>
                    </select>
                   
                </div>
               
            </div>
        </div>
</body>


<!-- Fontosm link -->
<script src="https://kit.fontawesome.com/7d08567bd4.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>


