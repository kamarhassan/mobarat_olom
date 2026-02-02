<?php ?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <title>School Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .header-section {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .title-box {
            font-size: 1.5em;
            font-weight: bold;
            margin: 10px 0;
            background-color: #3498db;
            color: white;
        }

        .main-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .left-box {
            flex: 1;
            min-width: 300px;
        }

        .right-box {
            flex: 1;
            min-width: 300px;
        }

        p {
            margin-bottom: 15px;
        }

        strong {
            color: #2c3e50;
            font-size: 1.1em;
        }

        embed {
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        @media (max-width: 768px) {
            .main-section {
                flex-direction: column;
            }

            .left-box,
            .right-box {
                width: 100%;
            }
        }

        /* Arabic font enhancement */
        body {
            font-family: 'Arial', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .left-box {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-right: 5px solid #3498db;
        }

        .left-box p {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #eee;
            position: relative;
        }

        .left-box p:last-child {
            border-bottom: none;
        }

        .left-box strong {
            color: #2c3e50;
            font-size: 1.2em;
            display: block;
            margin-bottom: 10px;
            padding-right: 15px;
            position: relative;
        }

        .left-box strong:before {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: #3498db;
            border-radius: 50%;
        }


        .pdf-container {
            width: 100%;
            height: 0;
            padding-bottom: 141.42%;
            /* A4 aspect ratio (height/width) */
            position: relative;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            margin-top: 15px;
        }

        .pdf-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>
    <div class="header-section">
        <!-- <?php var_dump($project) ?> -->
        <div class="box title-box">
            <?php echo CHtml::encode($project['school_name']); ?>
        </div>

        <div class="box title-box">
            <?php echo CHtml::encode($project['project_name']); ?>
        </div>
    </div>

    <div class="main-section">
        <div class="box left-box">
            <p><strong>الوصف:</strong><br><?php echo nl2br(CHtml::encode($project['project_description'])); ?></p>
            <p><strong>الهدف:</strong><br><?php echo nl2br(CHtml::encode($project['project_goal'])); ?></p>
            <p><strong>الأدوات:</strong><br><?php echo nl2br(CHtml::encode($project['project_tools'])); ?></p>
            <p><strong>الخطوات:</strong><br><?php echo nl2br(CHtml::encode($project['project_steps'])); ?></p>
        </div>

        <div class="box right-box">
            <?php if (!empty($project['project_attachment'])):
                // $path = '/' . rawurlencode($project['project_attachment']);
                $isPdf = strtolower(substr($project['project_attachment'], -4)) === '.pdf';
                $ext = pathinfo($project['project_attachment'], PATHINFO_EXTENSION);


                // var_dump($path);
            ?>
                <p><strong>الملف المرفق:</strong></p>
                <?php if ($isPdf): ?>

                    <!--  -->
                    <div class="pdf-container">
                        <embed src="<?php echo Yii::app()->baseUrl . '/' . ltrim($path, '/'); ?>"
                            width="100%"
                            height="500px"
                            type="application/pdf"
                            style="border: none;">
                        </embed>
                    </div>

                <?php else: ?>
                    <p>لا يوجد مرفق او صيغة المرفق ليست pdf</p>
                <?php endif; ?>
            <?php else: ?>
                <p>لا يوجد مرفق</p>
            <?php endif; ?>


        </div>
    </div>

</body>

</html>