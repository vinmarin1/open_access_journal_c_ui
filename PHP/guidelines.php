<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pahina | Guidelines</title>
    <link rel="stylesheet" href="../CSS/faqs.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../images/pahina-full.png">
</head>

<body>

    <header class="header-container" id="header-container">

    </header>

    <nav class="navigation-menus-container" id="navigation-menus-container">

    </nav>
<!-- Banners -->
    <div class="banner" id="banner-main" >
        <div class="content">
            <p><a href="index.php">Home</a> / Guidelines and Policies  </p>
            <div class="body">
                <h1 id="guideline-title">Guidelines and Policies</h1>
                <span>Let us guide you in the best way to present, organize and describe your worket us guide you in the best way to present, organize and describe your work</span><br/>
                <span class="last">View our Resources</span>
            </div>
        </div>
    </div>
    <div class="banner" id="author-guidelines-banner" style="display: none;">
        <div class="content">
            <p><a href="index.php">Home</a> / <a href="#">Guidelines and Policies</a> / Author Guidelines </p>
            <div class="body">
                <h1 id="guideline-title">Author Guidelines</h1>
                <span>Explore our author guidelines to ensure your submission meets all essential criteria for successful publication.</span><br/>
                <span class="last">Read more about our author guidelines</button>
            </div>
        </div>
        <img width="40%" src="../images/resources/1.png">
    </div>
    <div class="banner" id="article-submission-banner"  style="display: none;">
            <div class="content">
                <p><a href="index.php">Home</a> / <a href="#">Guidelines and Policies</a> / Article Submission </p>
                <div class="body">
                    <h1 id="guideline-title">Article Submission</h1>
                    <span>Enhance your submission's chances of acceptance by adhering to our guidelines and requirements</span><br/>
                    <span class="last">Read more about article submission</span>
                </div>
            </div>
            <img width="40%" src="../images/resources/2.png">
    </div>
    <div class="banner" id="peer-review-process-banner" style="display: none;">
            <div class="content">
                <p><a href="index.php">Home</a> / <a href="#">Guidelines and Policies</a> / Peer Review Process </p>
                <div class="body">
                    <h1 id="guideline-title">Peer Review Process</h1>
                    <span>Learn the peer-review process upholding the standards of scholarly integrity and academic excellence in our journal.</span><br/>
                    <span class="last">Read more about our Peer Review Process</button>
                </div>
            </div>
            <img width="40%" src="../images/resources/3.png">
    </div>
    <div class="banner" id="become-a-reviewer-banner" style="display: none;">
            <div class="content">
            <p><a href="index.php">Home</a> / <a href="#">Guidelines and Policies</a> / Become a Reviewer </p>
                <div class="body">
                    <h1 id="guideline-title">Become a Reviewer</h1>
                    <span>Contribute your expertise by joining our esteemed community of reviewers and help shape the course of academic research.</span><br/>
                    <span class="last">Read more about becoming a reviewer</button>
                </div>
            </div>
            <img width="40%" src="../images/resources/6.png">
    </div>
    <div class="banner" id="templates-for-author-banner" style="display: none;">
            <div class="content">
                <p><a href="index.php">Home</a> / <a href="#">Guidelines and Policies</a> / Templates for Author</p>
                <div class="body">
                    <h1 id="guideline-title">Templates for Author</h1>
                    <span> Streamline your writing process with our author templates, tailored for journal submissions.</span><br/>
                    <span class="last">View and download our templates</button>
                </div>
            </div>
            <img width="40%" src="../images/resources/4.png">
    </div>
    <div class="banner" id="publication-policy-banner" style="display: none;">
            <div class="content">
                <p><a href="index.php">Home</a> / <a href="#">Guidelines and Policies</a> / Publication Policy </p>
                <div class="body">
                    <h1 id="guideline-title">Publication Policy</h1>
                    <span>Understand the principles guiding our publication decisions and ethical standards.</span><br/>
                    <span class="last">Read our Publication Policies</button>
                </div>
            </div>
            <img width="40%" src="../images/resources/5.png">
    </div>
<!-- End of banners -->
    <main class="d-flex flex-column-reverse flex-md-row-reverse gap-2">
        <aside class="">
            <div class="menu" id="for-contributors-menu">
                <ul class="overview" id="author-guidelines-links" style="display: none;">
                    <li><b>Overview</b></li>
                    <li><a href="#types-of-publication">Types of Publication</a></li>
                    <li><a href="#accepted-file-formats">Accepted File Formats</a></li>
                    <li><a href="#formatting-requirements">Formatting Requirements</a></li>
                    <li><a href="#language-and-formatting">Language and Formatting</a></li>
                    <li><a href="#other-pages">Other Pages</a></li>
                </ul>
                <ul class="overview" id="article-submission-links" style="display: none;">
                    <li><b>Overview</b></li>
                    <li><a href="#submission">Submission</a></li>
                    <li><a href="#before-submission">Before Submission</a></li>
                    <li><a href="#terminologies">Terminologies</a></li>
                    <li><a href="#sample-credit-author-statement">Sample CRediT </a></li>
                    <li><a href="#other-pages">Other Pages</a></li>
                </ul>
                <ul class="overview" id="peer-review-process-links" style="display: none;">
                    <li><b>Overview</b></li>
                    <li><a href="#initial-check">Initial Check and Review</a></li>
                    <li><a href="#peer-review">Peer-review</a></li>
                    <li><a href="#editorial-decision">Editorial Decision & Revision</a></li>
                    <li><a href="#publication">Publication</a></li>
                </ul>
                <ul class="overview" id="become-a-reviewer-links" style="display: none;">
                    <li><b>Overview</b></li>
                    <li><a href="#types-of-publication">How to Become a Reviewer</a></li>
                </ul>
                <ul class="overview" id="templates-for-author-links" style="display: none;">
                    <!-- <li><b>Overview</b></li> -->
                    <!-- <li><a href="#types-of-publication">Types of Publication</a></li>
                    <li><a href="#accepted-file-formats">Accepted File Formats</a></li>
                    <li><a href="#formatting-requirements">Formatting Requirements</a></li>
                    <li><a href="#language-and-formatting">Language and Formatting</a></li>
                    <li><a href="#other-pages">Other Pages</a></li> -->
                </ul>
                <ul class="overview" id="publication-policy-links" style="display: none;">
                    <li><b>Overview</b></li>
                    <li><a href="#publication-ethics">Publication Ethics</a></li>
                    <li><a href="#publication-rules">Publication Rules</a></li>
                    <li><a href="#citation-policy">Citation Policy</a></li>
                    <li><a href="#copyright-licensing">Copyright and Licensing</a></li>
                    <li><a href="#institutional-repository">Institutional Repository</a></li>
                    <li><a href="#data-privacy">Data Privacy, and Others</a></li>
                </ul>
                <hr/>
                <ul id="for-contributors" >
                    <a href="guidelines.php"><li><b>Browse Pahina Resources</b></li></a>
                    <li class="faq-toggle" data-target="author-guidelines"><a href="guidelines.php#author-guidelines">Author Guidelines</a></li>
                    <li class="faq-toggle" data-target="templates-for-author"><a href="guidelines.php#templates-for-author">Templates for Author</a></li>
                    <li class="faq-toggle" data-target="publication-policy"><a href="guidelines.php#publication-policy">Publication Policy</a></li>
                    <li class="faq-toggle" data-target="article-submission"><a href="guidelines.php#article-submission">Article Submission</a></li>
                    <li class="faq-toggle" data-target="peer-review-process"><a href="guidelines.php#peer-review-process">Peer-review Process</a></li>
                    <li class="faq-toggle" data-target="become-a-reviewer"><a href="guidelines.php#become-a-reviewer">Become A Reviewer</a></li>
                    <br/>
    
                    <a href="tutorials.php"><li><b>Browse Tutorials</b></li></a>
                    <li class="faq-toggle"><a href="tutorials.php#tutorial-on-publication">Tutorial on Publication</a></li>
                    <li class="faq-toggle"><a href="tutorials.php#tutorial-on-review">Tutorial on Review</a></li>
                    <li class="faq-toggle"><a href="tutorials.php#tutorial-on-registration">How to be a Contributor</a></li>
                    <br/>
                    <a href="faqs.php"><li class="faq-toggle" data-target="frequently-asked-questions"><b>Browse FAQs</b></li></a>
                </ul>
            </div>           
        </aside>
        <div class="main  flex-column gap-4 my-5" id="guidelines-links">
            <h4>List of Pahina Resources</h4>
            <div data-animate-in="up" class="d-flex gap-3 flex-wrap">
                <a  href="#author-guidelines" data-target="author-guidelines" class="card-custom d-flex flex-column flex-sm-row gap-4 p-1 flex-row align-items-start">
                    <div class="icon">
                       <img class="img-fluid " src="../images/resources/1.png"/>
                    </div>
                    <div class="d-flex w-100 flex-column p-3">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Author Guidelines</h5>
                        </div>
                    
                        <small>Explore our author guidelines to ensure your submission meets all essential criteria for successful publication.</small>
                        <div class="mt-4">
                            <span>Read more...</span>
                        </div>
                    </div>
                    
                </a>
                <a  href="#article-submission" data-target="article-submission" class="card-custom d-flex flex-column flex-sm-row gap-4 p-1 flex-row align-items-start">
                    <div class="icon">
                        <img class="img-fluid " src="../images/resources/2.png"/>
                    </div>
                    <div class="d-flex w-100 flex-column p-3">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Article Submission</h5>
                        </div>
                        <small>Enhance your submission's chances of acceptance by adhering to our guidelines and requirements</small>
                        <div class="mt-4">
                            <span >Read more...</span>
                        </div>
                    </div>
                </a>
                <a  href="#peer-review-process" data-target="peer-review-process" class="card-custom d-flex flex-column flex-sm-row gap-4 p-1 flex-row align-items-start">
                    <div class="icon">
                        <img class="img-fluid " src="../images/resources/3.png"/>
                    </div>
                    <div class="d-flex w-100 flex-column p-3">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Peer Review Process</h5>
                        </div>
                        <small>Learn the peer-review process upholding the standards of scholarly integrity and academic excellence in our journal.</small>
                        <div class="mt-4">
                            <span >Read more...</span>
                        </div>
                    </div>
                </a>
                <a  href="#templates-for-author" data-target="templates-for-author" class="card-custom d-flex flex-column flex-sm-row gap-4 p-1 flex-row align-items-start">
                    <div class="icon">
                        <img class="img-fluid " src="../images/resources/4.png"/> 
                    </div>
                    <div class="d-flex w-100 flex-column p-3">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Templates for Author</h5>
                        </div>
                        <small>Streamline your writing process with our author templates, tailored for journal submissions.</small>
                        <div class="mt-4">
                            <span >Read more...</span>
                        </div>
                    </div>
                </a>
                <a  href="#publication-policy" data-target="publication-policy" class="card-custom d-flex flex-column flex-sm-row gap-4 p-1 flex-row align-items-start">
                    <div class="icon">
                        <img class="img-fluid " src="../images/resources/5.png"/>
                    </div>
                    <div class="d-flex w-100 flex-column p-3">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Publication Policy</h5>
                        </div>
                        <small>Understand the principles guiding our publication decisions and ethical standards.</small>
                        <div class="mt-4">
                            <span >Read more...</span>
                        </div>
                    </div>
                </a>
                <a  href="#become-a-reviewer" data-target="become-a-reviewer" class="card-custom d-flex flex-column flex-sm-row gap-4 p-1 flex-row align-items-start">
                    <div class="icon">
                        <img class="img-fluid " src="../images/resources/6.png"/>
                    </div>
                    <div class="d-flex w-100 flex-column p-3">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">Become a Reviewer</h5>
                        </div>
                        <small>Contribute your expertise by joining our esteemed community of reviewers and help shape the course of academic research.</small>
                        <div class="mt-4">
                            <span >Read more...</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="main" id="author-guidelines-container" style="display: none;"> 
            <div class="category w-100">
                <div class="s-1" id="types-of-publication">
                <h3>Types of Publication</h3>
                    <p>Manuscript length is unrestricted in Pahina, as long as the material is concise and comprehensive. To ensure that the results can be replicated, all practical information must be provided.</p>
                    <p>Manuscripts should not have been previously published or considered for publication in another journal when submitted to Pahina. The following are the main article types:</p>
                    <ul>
                        <li>
                            <span>Articles:</span>
                            <p>The journal accepts all original articles as long as they contain scientifically sound findings and provide important new information. The study’s quality and impact will be assessed during peer review.</p>
                        </li>
                    </ul>
                   
                    <p>For other types of publication, visit <a href="https://qcu.edu.ph/research-extension-and-linkages/academic-research-guide/" target="blank">QCU Publications</a> </p>
                    <!-- <h5>Book, Literature, and Critical Reviews:</h5>
                    <p>These provide concise and accurate updates on the most recent developments in a specific field of study.</p> -->
                </div>
                <div class="s-2" id="accepted-file-formats">
                    <h3>Accepted File Formats</h3>
                    <p>Authors must use either a <span>Microsoft Word template </span>in preparing their manuscripts. The time
                        it takes to finish copy-editing and publish accepted articles will be greatly reduced if
                        researchers use the template file designed and distributed by the Editorial Board of each
                        QCU Journal.</p>
                    <p>For Pahina templates, browse our <a href="#templates-for-author" target="blank">templates</a> </p>
                </div>
                <div class="s-2" id="formatting-requirements">
                    <h3>Formatting Requirements</h3>
                    <ul type="disc">
                        <li>At the top of your paper, please add an abstract and keywords.</li>
                        <li>Leave off page numbers, headers, and footers.</li>
                        <li>Submit your entire work as a single file, including tables, figures, and appendices
                            (Word or RTF files are accepted)</li>
                        <li>The paper should be 8.5 x 11 inches in size (Letter)</li>
                        <li>All margins (left, right, top, and bottom), including tables and figures, should be 1.5
                            inches (3.8 cm).</li>
                        <li>Keep your text single-spaced.</li>
                        <li>Use a single-column, justified layout.</li>
                        <li>Font:</li>
                        <ul type="circle">
                            <li>Main Body – 12 pt., Arial</li>
                            <li>References – 10 pt., Arial</li>
                            <li>Tables/Matrices – 10 pt., Arial</li>
                        </ul> 
                        <li>All paragraphs save those after a section heading should be indented. At least five
                            em-spaces should be intended.</li>  
                    </ul>
                </div>
                <div class="s-2" id="language-and-formatting">
                    <h3>Language, Grammar, and Formatting</h3>
                    <p>All contributions must be written in the English language (except for special cases). Filipino
                        quotations should be translated. Italics should be used for Filipino words. Authors should
                        adhere to good English grammar. The standard guide is the American Psychological
                        Association (APA) 7th Edition Publication Manual. The QCU Journal Publication format must
                        be followed for the overall publication format.</p>
                </div>
                <div class="s-2" id="other-pages">
                    <h3>Back Matter/Supplemental Pages</h3>
                    <ul type="disc">
                        <li><b>Supplementary Materials:</b> Describe any supplemental materials that have been
                            published with the manuscript online (figure, tables, video, etc.). Provide each element a
                            name and a title (ex. Table S1: title; Figure S1: title)</li>
                        <li><b>Funding:</b> The study’s funding sources should be made public. Indicate any funding
                                you’ve received in support of your research. Please provide the following information:
                                “This research received no outside funding” or “This research was financed by [name of
                                funder] grant number [xxx].</li>
                        <li><b>Author Contributions:</b> CRediT statements should be included in the submission of the
                                article, and should be displayed above the acknowledgment section of the published
                                manuscript.</li>
                        <li><b>Acknowledgements:</b> Researchers can thank anyone who helped them, especially those
                                not addressed in the financing sections. This could involve administrative and technical
                                assistance and in-kind gifts (e.g., materials used for experiments).</li>
                        <li><b>Conflict of Interest:</b> Any personal interest which can influence the authors’ interpretation
                                or analysis of published results must be disclosed. Please indicate “The authors declare
                                no conflict of interest” if there isn’t one. Any funding sponsors’ involvement in the study
                                design, data collection, analysis, interpretation, article authoring, or decision to publish
                                the results must also be indicated. If no role was played, please state, “The sponsors had
                                no involvement in the study design, data collection, analysis, or interpretation, manuscript
                                preparation, or the decision to publish the findings.”.</li>
                        <li><b>Ethnical Statement:</b> Researchers must mention that the study followed the rules of the
                                1975 Helsinki Declaration when publishing research involving human participants. Please
                                write: “All subjects gave their informed consent for inclusion in the study before
                                participating. The research protocol was approved by the QCU Research Ethics Board
                                (Project Identification Code), and the study followed the Declaration of Helsinki.”</li>
                    </ul>
                        <p>Manuscripts submitted for consideration in Pahina must follow the “IMRaD” format is
                            divided into four main sections: <b>I</b>ntroduction, <b>M</b>ethod, <b>R</b>esults, and <b>D</b>iscussion.</p>
                        <ul type="circle" style="margin-left:50px;">
                            <li><strong>Title: Short and to-the-point. Titles are often used in information
                                retrieval systems. Where possible, avoid abbreviations and formulas.</strong></li>
                            <li><b>Author Names, Affiliations, and ORCID.</b> Indicate each author's first and last
                                names, as well as their surnames, and make sure that all names are spelled
                                correctly. Underneath the writers' names, provide their affiliation and the
                                affiliation's main addresses, including city and main country name. Beneath
                                the address is the ORCID of the author. All authors should have their ORCID
                                indicated. <strong>The Corresponding Author should always be the first author in
                                the list of author names.</strong></li>
                            <li><b>Abstract:</b> This part summarizes the research (problem, objectives, purpose,
                                method, key findings, conclusions, and recommendations) in 250 to 300
                                words. Include at least five keywords at the end of the Abstract (keywords
                                should be in italics).</li>
                            <li><b>Introduction:</b> The introduction describes why the study is significant. Start
                                the introduction by stating the problem that prompted the investigation. Then
                                discuss the research gap in the topic by detailing the present state of
                                research in the field or discipline. Describe how the current research
                                addresses that problem or gap. Hypotheses are supplied at the end of the
                                introduction if the study has them for quantitative studies. This part consists of
                                the following: Background of the Study, Purpose of the Study, and Literature
                                Review.</li>
                            <li><b>Methods:</b> This part shows how the researcher carried out the research. It
                                contains details about the sample, procedures, equipment (if any), and the
                                study population. This section should allow other researchers and readers to
                                replicate the research. This part should be written in the past tense. It
                                consists of the following elements: Respondents/Participants/Artifacts,
                                Instrumentation, Validity and Reliability of Instrument, and Statistical
                                Treatment of Data.</li>
                            <li><b>Results:</b> The researcher/s must present their findings in this part. In most
                                cases, the Results section merely presents the findings, with no explanation
                                or critical interpretation. This part is also written in the past tense. Make sure
                                that each table and figure has its labeling and numbering. Tables have
                                captions above them, and figures have captions beneath them.</li>
                            <li><b>Discussion:</b> In this part, the researcher/s should summarize the significant
                                findings, develop valid interpretations, and connect them to other studies and
                                literature. The researcher/s should also acknowledge the study’s limitations
                                and suggest directions for future research. It consists of the following parts:
                                Interpretation of Data, Conclusions, and Recommendations.</li>
                            <li><b>References:</b> Complete set of references cited in the manuscript following
                                APA 7th Edition format.</li>
                            <li>After the References, indicate the <b>Back Matter / Supplemental Pages</b>.</li>
                        </ul> 
                          
                    
                </div>
            </div>
        </div>
    	<div class="main" id="article-submission-container" style="display: none;">
            <div class="category w-100">
                <div class="s-1" id="submission">
                <h3>Submission</h3>
                <p>Authors are kindly invited to submit their formatted full papers. All paper submissions will be blind peer 
                    reviewed and evaluated based on originality, research content, correctness, relevance to conference and 
                    readability. Please read complete submission and formatting guidelines before submitting your paper.</p>
                <ul>
                    <li>Create your account <a href="#">here</a>.</li>
                    <li>Online Submission: Paper Submission can be completed online, <a href="#">here</a>.</li>
                </ul>
                <p>The submitting author, generally the corresponding author, is in charge of the document during the submission
                    process. The submitting author must ensure that all qualified co-authors are listed in the
                    author list (see the University Policy on Authorship and Co-authorship in the QCU Research
                    Manual). The authors should have read and approved the final version of the article before
                    submission.</p>
                </div>
                <div class="s-1" id="before-submission">
                <h3>Before Submission</h3>
                    <p>Authors are expected to follow the journal’s publication guidelines before submitting their
                        manuscripts.</p>
                    <p>Submission of an article implies that the work described has not been published previously
                        (except in the form of an abstract, a published lecture, or an academic thesis); that it is not
                        under consideration or has been accepted for publication in any other journals; that all
                        authors were informed about its publication; and that, if accepted, the article will not be
                        published elsewhere.</p>
                    <p>Furthermore, submission of an article implies that all authors have a significant contribution
                        to the research, have approved the final article for publication, and have agreed to the
                        publication of the article.</p>
                    <p>In terms of author contributions, researchers should submit an author statement file outlining
                        their contributions to the article using the Contributor Roles Taxonomy (CRediT).</p>
                    <p>CRediT statement should be included in the submission of the article and should be
                        displayed above the acknowledgement section of the published manuscript. Below is a
                        specific definition of the terms according to Brand et al. (2015) and published in Elsevier.com
                        (n.d.).</p>
                </div>
                <div class="s-1" id="terminologies">
                    <table>
                        <tr>
                            <th>Term</th>
                            <th>Definition</th>
                        </tr>
                        <tr>
                            <td>Conceptualization</td>
                            <td>Ideas; formulation or evolution of overarching research goals and aims</td>
                        </tr>
                        <tr>
                            <td>Methodology</td>
                            <td>Development or design of methodology; creation of models</td>
                        </tr>
                        <tr>
                            <td>Software</td>
                            <td>Programming, software development; designing computer
                                programs; implementation of the computer code and supporting
                                algorithms; testing of existing code components.</td>
                        </tr>
                        <tr>
                            <td>Validation</td>
                            <td>Verification, whether as a part of the activity or separate, of the
                                overall replication/reproducibility of the results/experiments and
                                other research outputs</td>
                        </tr>
                        <tr>
                            <td>Formal Analysis</td>
                            <td>Application of statistical, mathematical, computational, or other
                                formal techniques to analyze or synthesize study data.</td>
                        </tr>
                        <tr>
                            <td>Investigation</td>
                            <td>Conducting a research and investigation process, specifically
                                performing the experiments, or data/evidence collection.</td>
                        </tr>
                        <tr>
                            <td>Resources</td>
                            <td>Provision of study materials, reagents, materials, patients,
                                laboratory samples, animals, instrumentation, computing
                                resources, or other analysis tools.</td>
                        </tr>
                        <tr>
                            <td>Data Curation</td>
                            <td>Management activities to annotate (produce metadata), scrub data,
                                and maintain research data (including software code, where it is
                                necessary for interpreting the data itself) for initial use and later
                                reuse.</td>
                        </tr>
                        <tr>
                            <td>Writing – Original Draft</td>
                            <td>Preparation, creation, and/or presentation of the published work,
                                specifically writing the initial draft (including substantive translation)</td>
                        </tr>
                        <tr>
                            <td>Writing – Review & Editing</td>
                            <td>Preparation, creation, and/or presentation of the published work by
                                those from the original research group, specifically critical review,
                                commentary, or revision – including pre or post publication stages</td>
                        </tr>
                        <tr>
                            <td>Visualization</td>
                            <td>Preparation, creation, and/or presentation of the published work,
                                specifically visualization/data presentation.</td>
                        </tr>
                        <tr>
                            <td>Supervision</td>
                            <td>Oversight and Leadership responsibility for the research activity
                                planning and execution, including mentorship external to the core
                                team.</td>
                        </tr>
                        <tr>
                            <td>Project administration</td>
                            <td>Management and coordination responsibility for the research
                                activity planning and execution</td>
                        </tr>
                        <tr>
                            <td>Funding acquisition</td>
                            <td>Acquisition of the financial support for the project leading to this
                                publication</td>
                        </tr>
                    </table>
                </div>
                <div class="s-1" id="sample-credit-author-statement">
                    <h3>CRediT author statement</h3>
                    <p><b>Dela Cruz:</b> Conceptualization, Methodology. <b>Bautista:</b> Data curation, Writing-Original draft
                            preparation. <b>Santos:</b> Visualization, Investigation. <b>Cruz:</b> Supervision. <b>Reyes:</b> Software,
                            Validation. <b>Jose:</b> Writing-Reviewing and Editing.</p>
                </div>
            </div>
        </div>
        <div class="main" id="peer-review-process-container" style="display: none;">
            <div class="category w-100">
            <div class="s-2" id="initial-check">
            <h3>Initial Check and Review</h3>
            <p>The Managing Editor will review submitted papers received by the Editorial Board to ensure
                that they are adequately prepared and adhere to the journal’s ethical policies. Manuscripts
                will be rejected before peer-review if they do not comply with the journal’s principles or meet
                its requirements. Manuscripts will be returned to the researchers for revision and
                resubmission if they are not properly prepared. Following the reviews, the Managing Editor
                will confer with the journal’s Editor-in-Chief to determine if the contribution is within the
                publication’s scope. At this time, no assessment of the work’s potential impact will be made.
                The Editor-in-Chief will double-check any rejection decisions made at this stage.</p>
            </div>
            <div class="s-2" id="peer-review">
            <h3>Peer-Review</h3>
            <p>Following the initial review, three experts will conduct a double-blind peer review of the
                manuscript, where the authors’ identities will be kept hidden from the reviewers. These
                experts will include faculty members from within and outside the University, industry experts,
                and the journal’s Editorial Board members. Reviewers should not have published any
                research works with any of the co-authors in the last five years, and they should not be
                working or collaborating with the co-authors’ department or college at the moment.</p>
            </div>
            <div class="s-1" id="editorial-decision">
            <h3>Editorial Decision and Revision</h3>
            <p>Following the peer-review process, the managing editor will inform the researchers of the
                decision of the editor-in-chief as follows:</p>
            <ul>
                <li><b>Accept with Minor Revisions:</b> Based on the reviewer’s suggestions, the article is in
                principle approved after minor changes have been made. Authors have five to ten
                days to complete the minor changes.</li>
                <li><b>Reconsider after Major Revisions:</b> The manuscript’s acceptance would be
                dependent on the revisions made by the author/s. If part of the reviewer’s comments
                cannot be amended, the author must respond in detail or present a rebuttal. Just one
                round of major revisions is allowed. Within 20 days, the authors must resubmit the
                revised work, and it will be given back to the reviewer for additional feedback.</li>
                <li><b>Reject and Encourage Resubmission:</b> The manuscript will be rejected if more
                analysis and experiments are necessary to support the study’s findings. The authors
                will be urged to resubmit the manuscript after the additional analysis is finished.</li>
                <li><b>Reject:</b> The article has multiple inaccuracies and/or makes no significant original
                contribution. There will be no invitation to resubmit to the journal.</li>
            </ul>
            <p>All the reviewers’ comments should be addressed in a table that contains the comment, the
                author’s (s) reaction or action, and the related page where the comment was made. When
                the authors disagree with a reviewer, they must express their disagreement clearly and
                concisely.</p>
            </div>
            <div class="s-2" id="publication">
            <h3>PUBLICATION</h3>
            <p>Following approval, the paper will go through copy-editing and author proofing, final edits,
                pagination checking, and publication in the journal.</p>
            </div>
            </div>
        </div>
        <div class="main" id="become-a-reviewer-container" style="display: none;">
            <div class="category w-100">
            <div class="s-1">
            <p>Becoming a reviewer for our open access journal is a rewarding opportunity. By joining us, you'll
                stay updated with the latest research, boost your career, and establish yourself as an expert in
                your field. Reviewers play a crucial role in maintaining the quality and integrity of scholarly articles.</p>
            <p>To get started, familiarize yourself with the peer review process, our guidelines, and terms and 
                conditions for reviewers. While reviewing may seem like a challenging task, it's essential for
                ensuring the reliability of research. We offer various incentives to appreciate and acknowledge
                the valuable contributions of our reviewers.</p>
            <p>Once registered on the submission system (sign up <a href="#">here</a>), your information will be
            added to our reviewer database automatically. Make sure to choose relevant keywords to help our editors
            match you with suitable articles for review. Join us in advancing knowledge and supporting scholarly research.</p>
            </div>
            </div>
    	</div>
        <div class="main" id="templates-for-author-container" style="display: none;">
            <div class="category w-100">
                <div class="s-1">
                <p>We have prepared a manuscript template to help authors when submitting their manuscript to one of our journals. 
                    The author must submit the manuscript that has been corrected and in accordance with the template provided. Before 
                    submitting the manuscript, please ensure that your paper is prepared using the QCU journal template. This will ensure 
                    fast processing and publication of your manuscript. Any script that does not meet the requirements under the guidelines 
                    for the author will not be processed or continued.</p>
                    <ul>
                        <li><a href='download.php?file=template-star.docx' onclick="downloadFile(event)">QCU Star - Journal of Science and Technology Article Template</a></li>
                        <li><a href='download.php?file=template-lamp.docx' onclick="downloadFile(event)">QCU Lamp - Journal of Education Article Template</a></li>
                        <li><a href='download.php?file=template-gavel.docx' onclick="downloadFile(event)">QCU Gavel - Journal of Social Sciences Article Template</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="main" id="publication-policy-container" style="display: none;">
            <div class="category w-100">
                <div class="s-1" id="publication-ethics">
                    <h3>Publication Ethics</h3>
                    <p>The editors of this journal use a rigorous peer-review system and adhere to strong ethical
                        values and standards to ensure that only high-quality research works are accepted.</p>
                    <p>Plagiarism, falsification, fabrication, unethical co-authorship practices, and other examples of
                        research misconduct are taken extremely seriously by the editors of Pahina. They are
                        instructed to deal with a zero-tolerance approach in such circumstances.</p>
                </div>
                <div class="s-2" id="publication-rules">
                    <h3>Publication Rules</h3>
                    <p>Researchers who wish to publish their articles or reviews in Pahina should abide by
                        the following:</p>
                    <ul>
                        <li><span>Conflict of interest disclosure:</span> Authors must disclose any potential conflicts of interest.</li>

                        <li><span>Accurate reporting:</span> Authors must accurately report research results and provide objective analysis.</li>
                            
                        <li><span>Transparency in methods:</span> Authors should explain study methods in detail for reproducibility.</li>                            
                        <li><span>Single journal submission:</span> Articles should not be submitted to multiple journals simultaneously.</li>
                            
                        <li><span>Originality requirement:</span> Republishing previously published content or work already available in another language is not permitted.</li>
                            
                        <li><span>Manuscript corrections:</span> Authors must promptly notify editors of any errors or inconsistencies post-publication for necessary action.</li>
                        <ul>
                            <li> An erratum must be published if serious errors could jeopardize the researchers’ work or reputation.</li>
                            
                            <li>If the findings are revealed to be incorrect, the researchers must sign a retraction describing the error and how it affected the manuscript and the study’s conclusions.</li>
                        </ul>    
                        <li><span>Content originality:</span> Manuscripts submitted to QCU Journals must be entirely original. Any reuse of previously published figures or images requires copyright holder's permission under the Creative Commons-BY license.</li>
                        <ul>    
                            <li>Plagiarism, fabrication, falsification of data, manipulation of the image, and other forms of research misconduct are not tolerated.</li>
                            
                            <li>Plagiarism refers to the act of representing as one’s original work the creative works of another, without appropriate acknowledgment of the author or source, even the researcher’s work (The University of Melbourne, n.d.).</li>
                            
                            <li>The manuscript will be rejected if any research misconduct is discovered throughout the peer-review process.</li>
                            
                            <li>If any scientific misconduct is discovered after the manuscript has been published, the editorial board may issue a correction or retract the paper.</li>
                        </ul>    
                        <li><span>Research misconduct:</span> Our editors promptly investigate research misconduct claims, taking corrective actions, including article retractions, when misconduct is confirmed. Authors publishing with Pahina must adhere to ethical publication standards.</li>
                    
                     
                    </ul>
                </div>
                <div class="s-2" id="citation-policy">
                    <h3>Citation Policy</h3>
                    <ul>
                        <li>Authors should ensure that information borrowed from other references is properly
                            referenced and obtained relevant permission from the original authors.</li>
                        <li>Self-citation of one’s work in excess should be avoided at all costs. Similarly, researchers
                            should avoid citing their own, friends’, or peers’ publications first.</li>
                        <li>Original wording obtained straight from the works of other scholars should be included in
                            quotation marks and accompanied by suitable citations.</li>
                    </ul>
                </div>
                <div class="s-2" id="copyright-licensing">
                    <h3>Copyright and Licensing</h3>
                    <p>The authors maintain copyright for all works published in the Pahina. The articles are
                        published under the <span>Creative Commons CC BY 4.0 license</span>, allowing anybody to download
                        and read them for free. The article may also be reused and quoted as long as the original
                        published version is referenced. These terms provide the most widespread use and visibility
                        of the work while guaranteeing that the creators are appropriately credited.</p>
                </div>
                <div class="s-2" id="institutional-repository">
                    <h3>Institutional Repository</h3>
                    <p>All articles published in the Pahina will be archived in the institutional repository
                        system and database of the Quezon City University.</p>
                </div>
                <div class="s-2" id="data-privacy">
                    <h3>Data Privacy, Intellectual Property, and Anti-Piracy</h3>
                    <p>All articles published in the Pahina should conform with the relevant rules, guidelines,
                        and policies indicated in the Philippines’ <span>Data Privacy Act of 2012, the Cybercrime
                        Prevention Act of 2012</span>, and the <span>Intellectual Property Code.</span></p>
                </div>
        </div>
        </div>

    </main>

    <div class="footer" id="footer">

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../JS/reusable-header.js"></script>

    <script src="../JS/faqs.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../JS/animate.js"></script>
<script>
function includeNavbar() {
  fetch('../PHP/navbar.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('navigation-menus-container').innerHTML = data;
      // Now that the content is loaded, you can attach event listeners or perform other operations as needed
      // For example, you can attach the notification button click event listener here
      attachNotificationButtonListener();
    })
    .catch(error => console.error('Error loading navbar.php:', error));
}

function attachNotificationButtonListener() {
  $(document).on('click', '#notification-button', function () {
    $("#notification-count").text("0");
    $("#notification-count").hide();
    // Send AJAX request to mark notifications as read
    $.ajax({
      url: "../PHP/mark_notifications_read.php",
      type: "POST",
      data: { author_id: <?php echo $_SESSION['id']; ?> },
      success: function (response) {
        console.log("Notifications marked as read:", response);
        // Update notification count on success
        // $("#notification-count").text("0");
        // $("#notification-count").hide();

      },
      error: function (xhr, status, error) {
        console.error("Error marking notifications as read:", error);
      }
    });
  });
}

// Call includeNavbar function to load navbar.php content
includeNavbar();


</script>
</body>

</html>