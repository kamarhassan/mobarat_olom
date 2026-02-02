<?php

class SiteController extends Controller
{

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('login', 'allPoster'), // add your public action here
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('SendEmail', 'forguet'),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('Download', 'Redirect'),
                'users' => array('@'),
            ),

            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        //if (!Yii::app()->user->isGuest) { //newwwwww
        //   $this->render('index');
        //}
        //else
        $this->redirect(Yii::app()->homeUrl . "/site/login");
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        //$clsEMail=new cls_EMail;

        $model = new LoginForm;
        if (Yii::app()->user->getState('attempts-login') >= 1) {
            //make the captcha required if the unsuccessful attemps are more of three
            $model->scenario = 'withCaptcha';
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if (strlen($model->username) > 0 && strlen($model->password) > 0) {
                if ($model->validate() && $model->login()) {
                    //if login is successful, reset the attemps
                    Yii::app()->user->setState('attempts-login', 0);
                    $clsPerson =  Person::getClsPerson();
                    if ($clsPerson != null) {
                        // echo $clsPerson->person_id;return;
                        //echo Yii::app()->user->id;return; 
                        Yii::app()->session['clsPerson'] = $clsPerson;

                        if ($clsPerson->user_type == '01') {
                            $this->redirect(array('Admin/Index'));
                        } elseif ($clsPerson->user_type == '02') {

                            $mobarat =  Mobarat::getOpenMobaratRecord();
                            //if(User::isParticipant($mobarat['mobarat_year'],Yii::app()->user->id))
                            //{
                            $this->redirect(array('participant/Index'));
                            // }    
                        }
                    } else

                        //  echo 'asdasd';return;
                        Yii::app()->user->logout();
                } else {
                    Yii::app()->user->setState('attempts-login', Yii::app()->user->getState('attempts-login') + 1);
                    if (Yii::app()->user->getState('attempts-login') >= 1) {
                        $model->scenario = 'withCaptcha';
                    }
                }
            } elseif (strlen($model->username_missing) > 0) {

                $mun = '11' . $model->username_missing;
                $mobarat =  Mobarat::getOpenMobaratRecord();
                $mail = $this->getEmail($mun, $mobarat['mobarat_year']);
                if ($mail != null) {
                    $msg_st = "<table cellpadding='10' style='border:1px solid black;border-collapse:collapse; direction:rtl'>
                            <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                            <tr ><td><p align='right'><font color='#4b8df8'>" . $mail['title'] . " :<font color='#4b8df8'><b>" . $mail['name']  . "</b> </font>   </p></td></tr>
                            <tr > <td><p align='right'>لتسجيل الدخول " . ":" . " http://mobarat.nasr.org.lb </p></tr>
                            <tr  bgcolor='#E0E0E0'><td><p align='right'> في خانة  اسم المستخدم MUN يجب كتابة الرقم الخاص بكم </p></td></tr>
                            <tr><td><p align='right'>MUN : <font color='#4b8df8'><b>" . $model->username_missing . "</b></font></p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='right'>كلمة المرور :<font color='#4b8df8'><b>" . $mail['pass']  . "</b></font></p></td></tr>
                            <tr><td><p align='right'>يمكنكم الاطلاع وتعديل بياناتكم من خلال الدخول إلى موقع التسجيل</p></td></tr>
                            </table>";

                    echo $msg_st;
                    return;

                    $clsEmail = new cls_EMail();
                    $clsEmailAddress = new cls_EmailAddress($mail['email'], $mail['name']);
                    if ($clsEmail->sendEMailWithStatic('forguet password', $msg_st, $clsEmailAddress) === true) {
                        echo "<script> alert(\"You will recive an email\")</script>";
                    } else {
                        echo "<script> alert(\"An error occurs when sending the mail\")</script>";
                    }
                } else {
                    echo "<script> alert(\"you are not registered\")</script>";
                }
            }
        }

        // display the login form
        //if ($bolRender==true)
        $maxYear =  Mobarat::getMaxYear();
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        $isClosed = true;
        $MaxSchoolNotAttemp = true;
        if ($currentMobarat != NULL) {
            $dateInfo = Mobarat::model()->findAll('openForRegistration=true');
            $d = new DateTime();
            $date = $d->format('Y-m-d');

            //if (strtotime($date) < strtotime($currentMobarat['last_register_school'])) 
            if (Mobarat::isOpenForRegisterSchool($currentMobarat))
                $isClosed = false;

            if (Mobarat::getSchoolCount($currentMobarat['mobarat_year']) >= $currentMobarat['maxNoOfSchool'])
                $MaxSchoolNotAttemp = false;
        }


        $this->renderPartial('login', array('model' => $model, 'maxYear' => $maxYear, 'isClosed' => $isClosed, 'MaxSchoolNotAttemp' => $MaxSchoolNotAttemp, 'current' => $currentMobarat));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        $mobarat =  Mobarat::getOpenMobaratRecord();
        if ($mobarat != null) {
            $clsPerson = Yii::app()->session['clsPerson'];
            if ($clsPerson != null) {
                if ($clsPerson->type == 'j') {
                    $query = "update project_judge set judgeislogin=0 where  mobarat_year=" . $mobarat['mobarat_year'] . " and judge_personId=" . $clsPerson->person_id;
                    Yii::app()->getDB()->createCommand($query)->execute();
                }
            }
        }

        Yii::app()->user->logout();

        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionForguet()
    {
        //$this->redirect(Yii::app()->homeUrl ."/site/forguet");
        $model = new forguetMail;
        //$model = new LoginForm;
        if (isset($_POST['forguetMail'])) {
            //echo "<script> alert(1)</script>";
            $model->attributes = $_POST['forguetMail'];
            //		echo "<script> alert(2)</script>";
            //	echo "<script> alert(\"". $model->email ."\")</script>";
            //$this->redirect(Yii::app()->createurl( "/MbAdmin/SendEmail") ,array('id' => $model->email));
            $model->result = "We will send your username and password to your email:" . $model->email;
            if ($this->isEMailExist($model->email) === true)
                $model->result = $model->result . " You are teacher";

            //$model->emailadd="123";
        }
        $this->render("forguet", array('model' => $model));
        //$this->render("forguet");
        //$this->redirect(Yii::app()->homeUrl . "/site/forguet" );
    }


    private function getEmail($mun, $yr)
    {
        $ids = User::model()->findAll('user_mun="' . $mun . '"');

        if (count($ids) > 0) {
            $userType = $ids[0]['user_type'];
            //echo "<script>alert(\"". count($ids) ."\")</script>";
            $userId = $ids[0]['user_id'];
            $pass = $ids[0]['user_password'];
            $emails = Person::model()->findAll('Person_userID="' . $userId . '"');
            if (count($emails) > 0) {
                $email = $emails[0]['Person_email1'];

                $name = $emails[0]['Person_fname'] . "  " . $emails[0]['Person_lname'];
                if (User::isStudentParticipant($yr, $userId)) {
                    $title = "جانب الطالب";
                } elseif (User::isTeacherParticipant($yr, $userId) || User::isOfTeacherParticipant($yr, $userId)) {
                    $title = "جانب الاستاذ";
                } else {
                    $title = "جانب السيد";
                }

                if ($emails[0]['Person_sex'] == 'أنثى')
                    $title = $title . "ة";
                //echo "<script>alert(\"". $name ."\")</script>";
                return  array('email' => $email, 'name' =>  $name, 'title' => $title, 'pass' => $pass);
                //return $emails(0)['student_email'];
            }
        }
        return null;
    }

    public function actionDownload($projectID, $fileName)
    {
        //$path=Yii::app()->request->hostInfo . Yii::app()->request->baseURL;
        //echo "<script>alert(\"" . $path . "\")</script>";
        $path = Yii::getPathOfAlias('webroot') . '/themes/classic/assets/attachments/file/' . $projectID . '/' . $fileName;
        if (file_exists($path)) {
            echo "<script>alert(\"file found\")</script>";
            return Yii::app()->getRequest()->sendFile($fileName, @file_get_contents($path));
        } else {
            echo "<script>alert(\"file not found\")</script>";
        }
    }
    public function actionRedirect()
    {
        $clsPerson = Yii::app()->session['clsPerson'];
        if ($clsPerson != null) {
            if ($clsPerson->user_type == '01') {
                $this->redirect(array('Admin/index'));
            } else {
                $this->redirect(array('Participant/index'));
            }
        }
    }


    public function actionAllPoster()
    {
        $this->layout = false;

        $limit = 150;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Get filter values from request
        $schoolName = isset($_GET['school']) ? $_GET['school'] : null;
        $projectYear = isset($_GET['year']) ? $_GET['year'] : null;

        // Base WHERE conditions
        $whereConditions = "p.project_attachment IS NOT NULL AND p.project_attachment != ''";

        // Add school filter if provided
        if (!empty($schoolName) && $schoolName != 'all') {
            $whereConditions .= " AND s.school_name LIKE :schoolName";
        }

        // Add year filter if provided
        if (!empty($projectYear) && $projectYear != 'all') {
            $whereConditions .= " AND p.mobarat_year = :projectYear";
        }

        // Count total projects with filters
        $countQuery = "SELECT COUNT(*) as total FROM project p JOIN school s ON p.school_id = s.school_id WHERE $whereConditions";
        $conn = Yii::app()->db->getPdoInstance();
        $countStmt = $conn->prepare($countQuery);

        // Bind parameters if filters are set
        if (!empty($schoolName) && $schoolName != 'all') {
            $countStmt->bindValue(':schoolName', '%' . $schoolName . '%', PDO::PARAM_STR);
        }
        if (!empty($projectYear) && $projectYear != 'all') {
            $countStmt->bindValue(':projectYear', $projectYear, PDO::PARAM_STR);
        }

        $countStmt->execute();
        $totalRow = $countStmt->fetch(PDO::FETCH_ASSOC);
        $totalProjects = $totalRow['total'];
        $totalPages = ceil($totalProjects / $limit);

        // Main query with filters
        $sql = "SELECT p.project_name, p.project_id, p.project_description, p.project_attachment, 
                   s.school_name, p.mobarat_year
            FROM project p
            JOIN school s ON p.school_id = s.school_id
            WHERE $whereConditions
            ORDER BY p.mobarat_year DESC, s.school_name ASC
            LIMIT $limit OFFSET $offset";

        $command = Yii::app()->db->createCommand($sql);

        // Bind parameters if filters are set
        if (!empty($schoolName) && $schoolName != 'all') {
            $command->bindParam(':schoolName', $schoolName, PDO::PARAM_STR);
        }
        if (!empty($projectYear) && $projectYear != 'all') {
            $command->bindParam(':projectYear', $projectYear, PDO::PARAM_STR);
        }

        $posters = $command->queryAll();

        // Get distinct years for filter dropdown
        $years = Yii::app()->db->createCommand("
        SELECT DISTINCT mobarat_year 
        FROM project 
        WHERE project_attachment IS NOT NULL AND project_attachment != ''
        ORDER BY mobarat_year DESC
    ")->queryColumn();

        // Get distinct schools for filter dropdown
        $schools = Yii::app()->db->createCommand("
        SELECT DISTINCT s.school_name 
        FROM school s
        JOIN project p ON p.school_id = s.school_id
        WHERE p.project_attachment IS NOT NULL AND p.project_attachment != ''
        ORDER BY s.school_name ASC
    ")->queryColumn();

        // If it's an AJAX request, return JSON
        if (Yii::app()->request->isAjaxRequest) {
            echo CJSON::encode([
                'posters' => $posters,
                'pagination' => [
                    'page' => $page,
                    'totalPages' => $totalPages,
                    'totalProjects' => $totalProjects,
                ]
            ]);
            Yii::app()->end();
        }

        $this->render('all_poster', [
            'posters' => $posters,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalProjects' => $totalProjects,
            'schools' => $schools,
            'years' => $years,
            'selectedSchool' => $schoolName,
            'selectedYear' => $projectYear,
        ]);
    }

    public function actionViewPdf($path)
    {
        // Security checks
        $path = str_replace(['../', '..\\'], '', urldecode($path));
        $basePath = Yii::getPathOfAlias('webroot') . '/pdfs/'; // Change to your PDF directory
        $absolutePath = realpath($basePath . $path);

        // Verify path is valid and within allowed directory
        if (strpos($absolutePath, realpath($basePath)) !== 0 || !file_exists($absolutePath)) {
            throw new CHttpException(404, 'File not found');
        }

        // Clear output buffers
        while (ob_get_level()) ob_end_clean();

        // Set consistent headers
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($absolutePath) . '"');
        header('Content-Length: ' . filesize($absolutePath));
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

        readfile($absolutePath);
        Yii::app()->end();
    }




    public function actionSchoolDetails($project_id)
    {


        // Fetch school details by ID or name (adjust query as needed)
        $this->layout = false;

        // Use DAO or ActiveRecord (example using raw SQL with DAO)
        $query_project_details = "
        SELECT 
            p.*, 
            s.school_name, 
            s.school_place, 
            s.school_street, 
            s.school_email, 
            s.school_phone
        FROM project p
        JOIN school s ON p.school_id = s.school_id
        WHERE p.project_id = :project_id
    ";

        $command = Yii::app()->db->createCommand($query_project_details);

        $command->bindParam(":project_id", $project_id, PDO::PARAM_INT);
        $projectDetails = $command->queryRow();

        if (!$projectDetails) {
            throw new CHttpException(404, 'Project not found.');
        }



        $sql = "SELECT mobarat_year FROM project WHERE project_id = :projectID";

        $mobarat_year = Yii::app()->db->createCommand($sql)
            ->bindValue(':projectID', $project_id)
            ->queryScalar();

        // Build the path


        $fileName = $projectDetails['project_attachment']; // Assuming project_attachment contains the file name



        $p = Project::model()->findByPK($project_id);



        //   $p= Project::model()->findByPK($project_id);
        if ($p != null) {
            //$path='D:\Apache24\htdocs\ssciencelb\protected\components\TCPDF\examples\images\logo-login.png';
            $temp = cls_attach::getAbsoluteFolderPath(enm_Program::PROJECT, $project_id);
            $path =  $temp . $p['project_attachment'];
            $bol = false;
            if (file_exists($path)) {
                $bol = true;
            } else {
                $ext = pathinfo($p['project_attachment'], PATHINFO_EXTENSION);
                $path =  $temp . $p['project_id'] . '.' . $ext;
                if (file_exists($path)) {
                    $bol = true;
                }
            }
        }



        // $baseUrl = 'http://mobarat.co/';

        // Find the position of "Data" in the path
        $pos = strpos($path, 'Data');

        // Extract the relative path starting from "Data"
        if ($pos !== false) {
            $relativePath = substr($path, $pos);

            // Replace backslashes with slashes (for Windows compatibility)
            $relativePath = str_replace('\\', '/', $relativePath);
        }

        $this->render(
            'project_details',
            [
                'path' => Yii::app()->baseUrl . '/' . ltrim($relativePath, '/'),
                'project' => $projectDetails,
                // 'p'=> $p,
            ]
        );
    }
}
