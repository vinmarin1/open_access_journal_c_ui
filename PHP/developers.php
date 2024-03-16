<?php
    include 'functions.php';
    $author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | ABOUT</title>
    <link rel="stylesheet" href="../CSS/developers.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="header-container" id="header-container" style="background-color: white;" >
</div>

<nav class="navigation-menus-container" id="navigation-menus-container">
</nav>
<body style="background-color: #E5F5FF;" >
    

<div class="main-content" id="home">
    <!-- <div class="content-over">
        <div class="cover-content">
            <p>Home / About Us / General Information</p>
            <h1>QCUJ Developers</h2>
        </div>
    </div>  -->
    
    <div class="container-fluid d-none second-container " >
        <div class="row">
            <div class="col-md-1"><!------ blank space -------></div>

            <div class="col-md-11 head-text">
                <div class="container-fluid row">
                    <div class="col-md-5 col-12">
                        <h4 class="mt-4" style="color:#F4900C" >We Think, We Research, We Write:</h4>
                        <h4 style="color:#FFFFFF" >Building Knowledge, Uniting Minds!</h4>
                        <hr style="height: 5px; background-color: #F4900C; width: 87%">
                    </div>
                        
                    <p >Explore, collaborate, and build knowledge together at QCU's Open Access Journal. Join us in uniting minds through research and writing, shaping a vibrant academic community.</p>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-------------- Leaders -------------->

<div class="container-fluid mt-4 text-center">
    <section class="d-flex flex-column justify-content-center align-items-center">
        <h2>Meet The Developer Team</h2>
        <p style="max-width: 700px;" class="text-muted">The QCUJ Developer Team consists of fourth-year BSIT students from QCU who collaborate to develop and enhance the QCUJ application, leveraging their skills and knowledge to create a user-friendly experience.</p>
    </section>
  
    <h3>Team Leaders</h3>
    <section class="d-flex flex-wrap gap-3 justify-content-center">
        <div class="mt-2 mb-2 leaders-content text-center">
            <img src="../images/baylon.png" alt="" class="img-fluid">
            <div class="description" >  
                <span class="mt-2" style="font-size:medium;">ELOISA MARIE M. BAYLON</span>
                <p style="font-weight:normal; font-size: small;">PROJECT MANAGER</p>
                <p style="font-weight:normal; font-size: small;  ">Leads the team, guiding the development process, and project documentation</p>
            </div>
            <div class="d-flex flex-wrap gap-1 justify-content-center ">
                <div class="col-md-2 col-2"><a href="https://www.facebook.com/eloisamaglana10/"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>
                <div class="col-md-2 col-2"><a href="mailto:eloisamariebaylon@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>
                <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/eloisamaglana?igsh=MzV3YWZ5ZzZtd3l0"><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->
                <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
            </div>
        </div>
        <div class="mt-2 mb-2 leaders-content text-center">
            <img src="../images/pangilinan.png" alt="" class="img-fluid">
            <div class="description " >
                <span class="mt-2" style="font-size:medium; ">KIMBERLY PANGILINAN</span>
                <p style="font-weight:normal; font-size: small; ">HEAD PROGRAMMER</p>
                <p style="font-weight:normal; font-size: small; " class="text-muted">Leads the development, and serves as machine developer & full-stack developer.</p>
            </div>
            <div class="d-flex flex-wrap gap-1 justify-content-center " >
                <div class="col-md-2 col-2 "><a href="https://www.facebook.com/IcnAzr/"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>
                <div class="col-md-2 col-2"><a href="mailto:kimberlypangilinan2001@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>
                <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/kimberlypangilinan/"><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
            </div>
        </div>
        <div class="mt-2 mb-2 leaders-content text-center">
            <img src="../images/pingol.png" alt="" class="img-fluid">
            <div class="description" >
                <span class="mt-2" style="font-size:medium;">EAN B. PINGOL</span>
                <p style="font-weight:normal; font-size: small;">HEAD RESEARCHER</p>
                <p style="font-weight:normal; font-size: small;  ">Leads documentation and research, ensures everything is well-documented </p>
            </div>

            <div class="d-flex flex-wrap gap-1 justify-content-center ">
             
                <div class="col-md-2 col-2 "><a href="https://www.facebook.com/ean.aesthetic"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                <div class="col-md-2 col-2"><a href="mailto:ean.pingol09gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->
                
                <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/pingol-ean-v-2978402ab/"><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
            </div>
        </div>
    </section>

    <!-------------- Members-------------->
    <h3>Designers & Developers</h3>
    <section class="d-flex flex-wrap gap-3 justify-content-center">
            <div class="mt-2 mb-2 members-content text-center">
                <img src="../images/elyana.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">ELYANA D. ESPAÑOLA </span>
                    <p style="font-weight:normal; font-size: small;">HEAD UI/UX DESIGNER</p>
                    <p style="font-weight:normal; font-size: small;  ">Leads the team in creating visually appealing and user-friendly interfaces</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
                 
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/elyana.espanola.5"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:elyana.espanola01@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/yandotyan/?igsh=NXRobHphOWQyYjIw&fbclid=IwAR1kCPgc-8k-eMfC-xFQ-WD5-oeZfWw64PWmWovhaWwC6_hJvtps4BfD0WY"><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>
            <div class="mt-2 mb-2 members-content text-center">
                <img src="../images/jacob.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">CLAIRE KAYE S. JACOB</span>
                    <p style="font-weight:normal; font-size: small;">UI/UX DESIGNER</p>
                    <p style="font-weight:normal; font-size: small; ">Focuses on creating visually appealing and user-friendly interfaces</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
                 
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/ClairekayeJacob/"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:clairekaye.jacob18@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/jacob-claire-kaye-s-0781542a9/"><i class="fa-brands fa-linkedin" style="color: blue;"></i></a></div>
                </div>
            </div>
            <div class="mt-2 mb-2 members-content text-center">
                <img src="../images/david.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">KYLE ANGELINE O. DAVID</span>
                    <p style="font-weight:normal; font-size: small;">UI/UX DESIGNER</p>
                    <p style="font-weight:normal; font-size: small;  ">Contributes on creating intuitive interfaces and as a front-end developer</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
                 
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/kyle.angeline.david/"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:kyleangeline.david2707@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/elyxne/"><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/kyleangelinedavid/"><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>


            <div class="mt-2 mb-2 members-content text-center">
                <img src="../images/monsenabre.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium">ARNEL MOSENABRE</span>
                    <p style="font-weight:normal; font-size: small;">DATABASE  DESIGNER</p>
                     <p style="font-weight:normal; font-size: small; "> Organizes database design and contributes as a back-end programmer</p> 
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center ">
                 
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/ArnelMosenabre5?mibextid=ZbWKwL"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:arnel.mosenabre05@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/rnl.msnbr?igsh=MWpqZG1xNDRkaHphNQ=="><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><i class="fa-brands fa-linkedin" style="color: blue;"></i></div>
                </div>
            </div>
        <div class="mt-2 mb-2 members-content text-center">
            <img src="../images/avila.png" alt="" class="img-fluid">
            <div class="description">
                <span class="mt-2" style="font-size:medium;">MON CEDRIC O. AVILA </span>
                <p style="font-weight:normal; font-size: small;">BACK-END PROGRAMMER</p>
                <p style="font-weight:normal; font-size: small; ">Programmed the entire admin side of the system, ensuring seamless functionality.</p>
            </div>
    
            <div class="d-flex flex-wrap gap-1 justify-content-center ">
             
                <div class="col-md-2 col-2"><a href="https://www.facebook.com/avilamon024"><i class="fab fa-facebook-f"
                            style="color: blue;"></i></a></div>
    
                <div class="col-md-2 col-2"><a href="mailto:moncedricavila@gmail.com"><svg
                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422" />
                            </svg></a></div>
    
                <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/cedricavila/"><i -->
                            <!-- class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->
    
                <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/mon-cedric-avila-a515ab20b/"><i
                            class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
            </div>
        </div>
        <div class="mt-2 mb-2 members-content text-center">
            <img src="../images/gozo.png" alt="" class="img-fluid">
            <div class="description">
                <span class="mt-2" style="font-size:medium;">MARVIN O. GOZO</span>
                <p style="font-weight:normal; font-size: small;">BACK-END PROGRAMMER</p>
                <p style="font-weight:normal; font-size: small;   ">Contributes both in front-end and back-end development of User Side</p>
            </div>
    
            <div class="d-flex flex-wrap gap-1 justify-content-center ">
             
                <div class="col-md-2 col-2"><a href="https://web.facebook.com/Vinmarin.08"><i class="fab fa-facebook-f"
                            style="color: blue;"></i></a></div>
    
                <div class="col-md-2 col-2"><a href="mailto:gozo.marvin23@gmail.com"><svg xmlns="http://www.w3.org/2000/svg"
                            width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422" />
                            </svg></a></div>
    
                <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/vinmarin_/"><i class="fa-brands fa-instagram" -->
                            <!-- style="color: blue;"></i></a></div> -->
    
                <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/marvin-gozo-23a86028a/"><i
                            class="fa-brands fa-linkedin" style="color: blue;"></i></a></div>
            </div>
        </div>
        <div class="mt-2 mb-2 members-content text-center">
            <img src="../images/heraldo.png" alt="" class="img-fluid">
            <div class="description">
                <span class="mt-2" style="font-size:medium;">STEPHEN ZION HERALDO</span>
                <p style="font-weight:normal; font-size: small;">FRONT-END PROGRAMMER</p>
                <p style="font-weight:normal; font-size: small;  ">Contributes front-end for user side with some help in back-end implementation</p>
            </div>
    
            <div class="d-flex flex-wrap gap-1 justify-content-center ">
             
                <div class="col-md-2 col-2"><a href="https://www.facebook.com/zion459"><i class="fab fa-facebook-f"
                            style="color: blue;"></i></a></div>
    
                <div class="col-md-2 col-2"><a href="mailto:stephenzionheraldo@gmail.com"><svg
                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422" />
                            </svg></a></div>
    
                <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->
    
                <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/stephen-zion-heraldo-2a90a2210/"><i
                            class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
            </div>
        </div>
        <div class="mt-2 mb-2 members-content text-center">
            <img src="../images/sanchez.png" alt="" class="img-fluid">
            <div class="description">
                <span class="mt-2" style="font-size:medium;">DHARREN PAUL SANCHEZ</span>
                <p style="font-weight:normal; font-size: small;">FRONT-END PROGRAMMER</p>
                <p style="font-weight:normal; font-size: small;  ">Contributes front-end for user side, ensuring responsiveness and good UX</p>
            </div>
    
            <div class="d-flex flex-wrap gap-1 justify-content-center ">
             
                <div class="col-md-2 col-2"><a href="https://www.facebook.com/dharren13/"><i class="fab fa-facebook-f"
                            style="color: blue;"></i></a></div>
    
                <div class="col-md-2 col-2"><a href="mailto:dharren.sanchez023@gmail.com"><svg
                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422" />
                            </svg></a></div>
    
                <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->
    
                <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
            </div>
        </div>
    </section>


    <!--------- system analysts --------->

    <h3>System Analysts</h3>

    <section class="d-flex flex-wrap gap-3 justify-content-center">
            <div class="mt-2 mb-2 members-content text-center">
                <img src="../images/de-jesus.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">JUSTIN DANIEL C. DE JESUS</span>
                    <p style="font-weight:normal; font-size: small;">HEAD SYSTEM ANALYST</p>
                    <p style="font-weight:normal; font-size: small;  ">Leads in assessing and optimizing system requirements for successful outcomes.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/justindaniel.dejesus"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:justindanieldejesus4@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>
            <div class="mt-2 mb-2 members-content text-center">
                <img src="../images/dela-cruz.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">JOHN ALBERT T. DELA CRUZ</span>
                    <p style="font-weight:normal; font-size: small;">SYSTEM ANALYST</p>
                    <p style="font-weight:normal; font-size: small;  ">Ensures and evaluates quality assurance throughout the project lifecycle.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center ">
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/jobertomapagmahal"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:johnalbert.delacruz025@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></i></a></div>
                </div>
            </div>
            <div class="mt-2 mb-2 members-content text-center">
                <img src="../images/jacinto.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">FATIMA C. JACINTO</span>
                    <p style="font-weight:normal; font-size: small;">SYSTEM ANALYST</p>
                    <p style="font-weight:normal; font-size: small;  ">Manages and maintains quality assurance throughout the project lifecycle.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " style="padding-top: 15px;" >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/jfatima30"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:jacintofatimamae@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/_jftm30?igsh=MXdmM294dGdiYmNqMw=="><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>
        </section>

        <!--------- DOCUMENTATION/RESEARCHER --------->

    
        <h3>Research Team</h3>
          

    <section class="d-flex flex-wrap gap-3 justify-content-center">
            <div class="mt-2  members-content text-center">
                <img src="../images/noel.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">MARICAR D. NOEL </span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small;  ">Highly skilled and stands out as an exceptional technical writer and researcher.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/maricar.noel.5?mibextid=ZbWKwL"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:maricar.noel1099@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>
            <div class="mt-2 members-content text-center">
                <img src="../images/agustin.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">DAPHINE A. AGUSTIN</span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small; ">Highly skilled and stands out as an exceptional technical writer and researcher.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://m.facebook.com/profile.php/?id=100007453394238"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:daphine.agustin3@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href="https://www.linkedin.com/in/agustin-daphine-a-03385b2b2/"><i class="fa-brands fa-linkedin" style="color: blue;"></i></a></div>
                </div>
            </div>
            <div class="mt-2 members-content text-center">
                <img src="../images/narisma.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">QUENIE ELAIZA P. NARISMA</span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small;  ">Excels as a technical writer & researcher with a focus on literature reviews and diagram creation</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://m.facebook.com/profile.php/?id=100002271849524"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:quenieelaiza.narisma08@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/kwini.ela/"><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>
            <div class="mt-2  members-content text-center">
                <img src="../images/lamberte.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">JOHNCEL C. LAMBERTE</span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small;  ">Contributes to creating detailed technical documentation while also conducting research</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/johncelcasipong?mibextid=LQQJ4d"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:johncel.lamberte14@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>
            <div class="mt-2 members-content text-center">
                <img src="../images/nalam.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">JUSTIN NEIL P. NALAM </span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small;  ">Contributes essential support in transcribing documents. As a technical writer and researcher, enhances the clarity and accuracy of our project documentation.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/supremacytatin"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:neiljustin.nalam05@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>


        
            <div class="mt-2  members-content text-center">
                <img src="../images/ayag.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">RICHMONDE M. AYAG</span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small;  ">Contributes to creating detailed technical documentation while also conducting research to enhance project understanding and content accuracy.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/profile.php?id=61550341311245&mibextid=ZbWKwL"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:Richmonde.ayag002@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/hiromi_midorikawa24?igsh=MTRhZzFkcjJ6andpeQ=="><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></i></a></div>
                </div>
            </div>
            <div class="mt-2 members-content text-center">
                <img src="../images/malazarte.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size: 13px;">MASTERSON KURT MALAZARTE</span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size:small; ">Contributes to creating detailed technical documentation while also conducting research to enhance project understanding and content accuracy.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " style="padding-top: 4px"  >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/kurtmalazarte.17"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:mastersonkurt.malazarte17@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>


            <div class="mt-2 members-content text-center">
                <img src="../images/cuagon.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">REVEAN G. CUAGON</span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small;  ">Contributes to creating detailed technical documentation while also conducting research to enhance project understanding and content accuracy.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/rvkwa"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:revean.gabatbat.cuagon@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>

            <div class="mt-2  members-content text-center">
                <img src="../images/delos-reyes.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size: 14px;">ERIC JOHNES A. DELOS REYES </span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small;  ">Contributes to creating detailed technical documentation while also conducting research to enhance project understanding and content accuracy.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/itsmeejhayyy?mibextid=LQQJ4d"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:Ericjohnesdelosreyes@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href="https://www.instagram.com/ejdlsrys_?igsh=c2cyZHA4azY0bG9m&utm_source=qr"><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></a></i></div>
                </div>
            </div>

            <div class="mt-2  members-content text-center">
                <img src="../images/gutierrez.png" alt="" class="img-fluid">
                <div class="description" >
                    <span class="mt-2" style="font-size:medium;">DYLAN D. GUTIERREZ</span>
                    <p style="font-weight:normal; font-size: small;">TECHNICAL WRITER/RESEARCHER</p>
                    <p style="font-weight:normal; font-size: small; ">Contributes to creating detailed technical documentation while also conducting research to enhance project understanding and content accuracy.</p>
                </div>

                <div class="d-flex flex-wrap gap-1 justify-content-center " >
             
                    <div class="col-md-2 col-2"><a href="https://www.facebook.com/Dylanscxz10"><i class="fab fa-facebook-f" style="color: blue;"></i></a></div>

                    <div class="col-md-2 col-2"><a href="mailto:dylan.deleon.gutierrez@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M32 6v20c0 1.135-.865 2-2 2h-2V9.849l-12 8.62l-12-8.62V28H2c-1.135 0-2-.865-2-2V6c0-.568.214-1.068.573-1.422A1.973 1.973 0 0 1 2 4h.667L16 13.667L29.333 4H30c.568 0 1.068.214 1.427.578c.359.354.573.854.573 1.422"/></svg></a></div>

                    <!-- <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-instagram" style="color: blue;"></i></a></div> -->

                    <div class="col-md-2 col-2"><a href=""><i class="fa-brands fa-linkedin" style="color: blue;"></i></a></div>
                </div>
            </div>
</section>

</div>











<div class="footer" id="footer">
</div>

<script>
    const sessionId = "<?php echo $author_id; ?>";
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../JS/reusable-header.js"></script>
</body>

</html>