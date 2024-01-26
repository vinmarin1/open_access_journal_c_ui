<?php
session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | GUIDELINES</title>
    <link rel="stylesheet" href="../CSS/faqs.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <header class="header-container" id="header-container">

    </header>

    <nav class="navigation-menus-container" id="navigation-menus-container">

    </nav>

    <div class="content-over">
        <div class="cover-content">
            <p>Home / Guidelines / For Contributors</p>
            <h1 id="guideline-title">Author Guidelines</h1>
        </div>
    </div>

    <main class="d-flex flex-column-reverse flex-md-row gap-2">
    <aside class="">
        <div class="menu" id="for-contributors-menu">
            <h3>For Contributors</h3>
            <ul id="for-contributors">
                <li class="faq-toggle" data-target="author-guidelines">Author Guidelines</li>
                <li class="faq-toggle" data-target="article-submission">Article Submission</li>
                <li class="faq-toggle" data-target="peer-review">Peer-review Process</li>
                <li class="faq-toggle" data-target="become-reviewer">Become A Reviewer</li>
                    <li>Formatting Guidelines</li>
                    <li>Tutorial on Publication</li>
                    <li>Research Manual</li>
                </ul>
            </div>           
        </aside>
    <div class="main" id="author-guidelines-container">
        <div class="header">
        <h2>Author Guidelines</h2>
        </div>
        <div class="category w-100">
        <div class="s-1">
        <h3>Types of Publication</h3>
            <p>Manuscript length is unrestricted in QCU Journals, as long as the material is concise and comprehensive. To ensure that the results can be replicated, all practical information must be provided.</p>
            <p>Manuscripts should not have been previously published or considered for publication in another journal when submitted to QCU Journals. The following are the main article types:</p>
            <h4>Articles:</h4>
            <p>The journal accepts all original articles as long as they contain scientifically sound findings and provide important new information. The study’s quality and impact will be assessed during peer review.</p>

            <h4>Book, Literature, and Critical Reviews:</h4>
            <p>These provide concise and accurate updates on the most recent developments in a specific field of study.</p>
        </div>
        <div class="s-2">
            <h3>Accepted File Formats</h3>
            <p>Authors must use either a Microsoft Word template in preparing their manuscripts. The time
                it takes to finish copy-editing and publish accepted articles will be greatly reduced if
                researchers use the template file designed and distributed by the Editorial Board of each
                QCU Journal.</p>
        </div>
        <div class="s-2">
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
        <div class="s-2">
            <h3>Language, Grammar, and Formatting</h3>
            <p>All contributions must be written in the English language (except for special cases). Filipino
                quotations should be translated. Italics should be used for Filipino words. Authors should
                adhere to good English grammar. The standard guide is the American Psychological
                Association (APA) 7th Edition Publication Manual. The QCU Journal Publication format must
                be followed for the overall publication format.</p>
        </div>
        <div class="s-2">
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
                <p>Manuscripts submitted for consideration in QCU Journals must follow the “IMRaD” format is
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
        <div class="header">
        <h2>Article Submission</h2>
        </div>
        <div class="category w-100">
        <div class="s-1">
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
        <div class="s-1">
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
        <div class="s-1">
            <p><em>Sample CRediT author statement</em></p>
            <p><b>Dela Cruz:</b> Conceptualization, Methodology. <b>Bautista:</b> Data curation, Writing-Original draft
                    preparation. <b>Santos:</b> Visualization, Investigation. <b>Cruz:</b> Supervision. <b>Reyes:</b> Software,
                    Validation. <b>Jose:</b> Writing-Reviewing and Editing.</p>
        </div>
        </div>
    </div>
    <div class="main" id="peer-review-container" style="display: none;">
        <div class="header">
        <h2>Editorial Procedures and Peer-Review</h2>
        </div>
        <div class="category w-100">
        <div class="s-2">
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
        <div class="s-2">
        <h3>Peer-Review</h3>
        <p>Following the initial review, three experts will conduct a double-blind peer review of the
            manuscript, where the authors’ identities will be kept hidden from the reviewers. These
            experts will include faculty members from within and outside the University, industry experts,
            and the journal’s Editorial Board members. Reviewers should not have published any
            research works with any of the co-authors in the last five years, and they should not be
            working or collaborating with the co-authors’ department or college at the moment.</p>
        </div>
        <div class="s-1">
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
        <div class="s-2">
        <h3>PUBLICATION</h3>
        <p>Following approval, the paper will go through copy-editing and author proofing, final edits,
            pagination checking, and publication in the journal.</p>
        </div>
        </div>
    </div>
    <div class="main" id="become-reviewer-container" style="display: none;">
        <div class="header">
        <h2>Become A Reviewer</h2>
        </div>
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
</body>

</html>