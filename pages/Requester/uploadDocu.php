<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../../");
        die();
    }
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tag -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Document</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/img/logo.png" type="stylesheet" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <!-- Boostrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <!-- icons:font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../css/requester.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3.0.0"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Requester</a>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a class="nav-link" href="./requester.php">
                            <span class="fas fa-home"></span>
                            Home
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="nav-link" href="./uploadDocu.php">
                            <span class="fas fa-file-alt"></span>
                            Upload Document
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <!-- Button to trigger the modal -->
                        <a href="put-link-here" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                            <span class="fas fa-sign-out-alt"></span>
                            Log out
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Component -->
        <div class="main">
            <div class="container-fluid navbar-container">
            </div>
            <div class="row">
                <div class="col users-label">
                    <h1>
                        Upload a Document
                    </h1>
                </div>
            </div>

            <div class="row justify-content-center px-5 mt-3">
                <div class="col-md-12">
                    <div class="card shadow-2-strong">
                        <div class="card-body">
                            <div class="table-responsive">

                            <form action="http://localhost:3000/upload" method="POST" enctype="multipart/form-data">
                                    <div class="docu-title">
                                        <h2>Document Title:</h2>
                                        <input type="text" name="title">

                                        <h2>Office:</h2>
                                        <select class="form-select" id="office" name="office">
                                        <?php
                                        include '../../php/db.php';

                                        $sql = "SELECT * FROM offices;";

                                        $st = $conn->prepare($sql);

                                        $st->execute();

                                        $res = $st->get_result();
                                        $r = $res->fetch_row();
                                        //echo $r;

                                        $ar = [];


                                        if ($res->num_rows > 0) {
                                            while ($row = $res->fetch_assoc()) {
                                            
                                                $ar[] = "<option value=".$row['officeID'].">".$row['officeName']."</option>";
                                                
                                            }
                                        }
                                        foreach ($ar as $item) {
                                            echo $item;
                                        }  ;
                                        ?>
                                        </select>

                                    </div>
                                    
                                    <!-- <div class="docu-type">
                                        <h2>Document Type:</h2>
                                        <input type="text" name="documentType">
                                    </div> -->

                                    <div class="wrapper-box">
                                        <div class="box">
                                            <div class="input-bx">
                                                <h2 class="upload-area-title">Upload File</h2>
                                                
                                                    <input type="file" id="upload" accept=".doc, .docx, .pdf" name="files" required multiple>
                                                    <!-- <label for="upload" class="uploadlabel">
                                                        <span><i class="fa fa-cloud-upload-alt"></i></span>
                                                        <p>Click To Upload</p>
                                                    </label> -->

                                                
                                            </div>

                                            <!-- <div id="filewrapper">
                                                <h3 class="uploaded">Uploaded Document</h3>
                                            </div> -->

                                        </div>
                                    </div>
                                    <div class="upload-btn">
                                        <button value="<?php echo $_SESSION['uid']?>" name="uid" type="submit" class="upload">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to log out?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="../../php/logout.php" class="btn btn-danger">Log out</a>
                </div>
            </div>
        </div>
    </div>
    <!--End of Modal-->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const activePageLocation = window.location.pathname;
        const navLinks = document.querySelectorAll(".nav-link");
        navLinks.forEach(links => {
            if (links.href.includes(activePageLocation)) {
                links.classList.add('active');
            }
        });
    </script>

    <!-- Upload File Script(Not Yet Finished-->
    <script>
        window.addEventListener("load", ()=>{
            const input = document.getElementById("upload");
            const filewrapper = document.getElementById("filewrapper");
            
            input.addEventListener("change", (e)=>{
                let fileName = e.target.files[0].name;
                let filetype = e.target.value.split(".").pop();
                fileshow(fileName, filetype);
            })
    
            const fileshow=(fileName, filetype)=>{
                const showfileboxElem = document.createElement("div");
                showfileboxElem.classList.add("showfilebox");
                const leftElem = document.createElement("div");
                leftElem.classList.add("left");
                const filetypeElem = document.createElement("span");
                filetypeElem.classList.add("filetype");
                filetypeElem.innerHTML=filetype;
                leftElem.append(filetypeElem);
                const filetitleElem = document.createElement("h3");
                filetitleElem.innerHTML=fileName;
                leftElem.append(filetitleElem);
                showfileboxElem.append(leftElem);
                const rightElem = document.createElement("div");
                rightElem.classList.add("right");
                showfileboxElem.append(rightElem);
                filewrapper.append(showfileboxElem);
                const crossElem = document.createElement("span");
                crossElem.innerHTML="&#215;";
                rightElem.append(crossElem); 
    
                crossElem.addEventListener("click",()=>{
                    filewrapper.removeChild(showfileboxElem);
                })
            }
    
        })
    </script>

</body>

</html>