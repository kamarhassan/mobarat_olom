 <?php

    /*foreach($posters as $poster): ?>
            <img src="<?php echo CHtml::encode($poster['image_path']); ?>" alt="Poster">
        <?php endforeach; ?>

        **/
    // var_dump($posters);
    //         if ($posters->num_rows > 0) {
    //     while($row = $posters->fetch_assoc()) {
    //         echo "<h3>" . htmlspecialchars($row["project_name"]) . "</h3>";
    //         echo "<p><strong>Description:</strong> " . nl2br(htmlspecialchars($row["project_description"])) . "</p>";
    //         echo "<p><strong>School:</strong> " . htmlspecialchars($row["school_name"]) . 
    //              " | <strong>Year:</strong> " . $row["mobarat_year"] . "</p>";
    //         echo "<img src='path/to/attachments/" . htmlspecialchars($row["project_attachment"]) . "' alt='Project Poster' style='max-width:300px;'><hr>";
    //     }
    // } else {
    //     echo "No results found.";
    // }

    // // Pagination controls
    // echo "<div style='margin-top:20px;'>";
    // if ($page > 1) {
    //     echo "<a href='?page=" . ($page - 1) . "'>⟵ Previous</a> ";
    // }
    // if ($page < $totalPages) {
    //     echo "<a href='?page=" . ($page + 1) . "'>Next ⟶</a>";
    // }
    // echo "</div>";
    ?>



 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>School Projects</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
     <style>
         .projects-container {
             display: flex;
             flex-direction: column;
             gap: 15px;
             padding: 20px;
         }

         .project-card {
             border: 1px solid #ddd;
             border-radius: 5px;
             padding: 15px;
             background-color: #f9f9f9;
         }

         .projects-container {
             display: grid;
             grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
             gap: 20px;
             padding: 20px;
         }

         .project-card {
             border: 1px solid #ddd;
             border-radius: 8px;
             padding: 15px;
             background-color: #f9f9f9;
         }

         .school-name {
             margin-top: 0;
             color: #333;
             border-bottom: 1px solid #eee;
             padding-bottom: 10px;
         }

         .project-description {
             color: #666;
             font-size: 14px;
             line-height: 1.5;
         }

         .school-name {
             margin-top: 0;
             color: #333;
             border-bottom: 1px solid #eee;
             padding-bottom: 10px;
             text-align: right;
             /* Add this line */
             font-weight: bold;
             color: #2196f3;
             /* Sky blue */
             text-shadow: 1px 1px 2px #b3e0ff;
             letter-spacing: 1px;
         }

         [data-pagination],
         [data-pagination] *,
         [data-pagination] *:before,
         [data-pagination] *:after {
             -webkit-box-sizing: border-box;
             -moz-box-sizing: border-box;
             box-sizing: border-box;
             text-rendering: optimizeLegibility;
             -webkit-font-smoothing: antialiased;
             -moz-osx-font-smoothing: grayscale;
             font-kerning: auto;
         }

         [data-pagination] {
             font-size: 8pt;
             line-height: 1;
             font-weight: 400;
             font-family: 'Open Sans', 'Source Sans Pro', Roboto, 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', 'Myriad Pro', 'Segoe UI', Myriad, Helvetica, 'Lucida Grande', 'DejaVu Sans Condensed', 'Liberation Sans', 'Nimbus Sans L', Tahoma, Geneva, Arial, sans-serif;
             -webkit-text-size-adjust: 100%;
             margin: 1em auto;
             text-align: center;
             transition: font-size .2s ease-in-out;
         }

         [data-pagination] ul {
             list-style-type: none;
             display: inline;
             font-size: 100%;
             margin: 0;
             padding: .5em;
         }

         [data-pagination] ul li {
             display: inline-block;
             font-size: 100%;
             width: auto;
             border-radius: 3px;
         }

         [data-pagination]>a {
             font-size: 140%;
         }

         [data-pagination] a {
             color: #777;
             font-size: 100%;
             padding: .5em;
         }

         [data-pagination] a:focus,
         [data-pagination] a:hover {
             color: #f60;
         }

         [data-pagination] li.current {
             background: rgba(0, 0, 0, .1)
         }

         /* Disabled & Hidden Styles */
         [data-pagination] .disabled,
         [data-pagination] [hidden],
         [data-pagination] [disabled] {
             opacity: .5;
             pointer-events: none;
         }

         @media (min-width: 350px) {
             [data-pagination] {
                 font-size: 10pt;
             }
         }

         @media (min-width: 500px) {
             [data-pagination] {
                 font-size: 12pt;
             }
         }

         @media (min-width: 700px) {
             [data-pagination] {
                 font-size: 14pt;
             }
         }

         @media (min-width: 900px) {
             [data-pagination] {
                 font-size: 16pt;
             }
         }

         [data-pagination] ul {
             display: inline-flex;
             flex-wrap: wrap;
             justify-content: center;
             gap: 2px;
         }

         [data-pagination] ul li {
             min-width: 2em;
             text-align: center;
         }

         [data-pagination] a {
             display: inline-block;
             min-width: 1.5em;
             padding: .5em;
             text-decoration: none;
         }

         [data-pagination] .current a {
             font-weight: bold;
             color: #000;
         }

         .filters {
             background-color: #f5f5f5;
             padding: 15px;
             border-radius: 5px;
             margin-bottom: 20px;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         }

         .filters form {
             display: flex;
             flex-wrap: wrap;
             align-items: center;
             gap: 15px;
         }

         .filters label {
             font-weight: 600;
             color: #333;
             margin-right: 5px;
         }

         .filters select {
             padding: 8px 12px;
             border: 1px solid #ddd;
             border-radius: 4px;
             background-color: white;
             font-size: 14px;
             color: #333;
             cursor: pointer;
             transition: border-color 0.3s;
         }

         .filters select:hover {
             border-color: #999;
         }

         .filters select:focus {
             outline: none;
             border-color: #4a90e2;
             box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
         }

         .filters button[type="submit"] {
             padding: 8px 16px;
             background-color: #4a90e2;
             color: white;
             border: none;
             border-radius: 4px;
             cursor: pointer;
             font-size: 14px;
             transition: background-color 0.3s;
         }

         .filters button[type="submit"]:hover {
             background-color: #3a7bc8;
         }

         .filters a {
             padding: 8px 16px;
             color: #4a90e2;
             text-decoration: none;
             border: 1px solid #4a90e2;
             border-radius: 4px;
             font-size: 14px;
             transition: all 0.3s;
         }

         .filters a:hover {
             background-color: #f0f7ff;
         }

         /* Responsive adjustments */
         @media (max-width: 768px) {
             .filters form {
                 flex-direction: column;
                 align-items: stretch;
             }

             .filters form>* {
                 width: 100%;
             }

             .filters select,
             .filters button,
             .filters a {
                 width: 100%;
                 box-sizing: border-box;
             }
         }

         .filters form {
             display: flex;
             flex-wrap: wrap;
             align-items: center;
             gap: 15px;
         }

         .filters label {
             font-weight: 600;
             color: #333;
             margin-right: 5px;
         }

         /* Select2 custom styles */
         .filters .select2-container {
             min-width: 200px;
         }

         .filters .select2-selection {
             padding: 6px 12px;
             border: 1px solid #ddd !important;
             border-radius: 4px !important;
             height: auto !important;
             font-size: 14px;
         }

         .filters .select2-selection:hover {
             border-color: #999 !important;
         }

         .filters .select2-selection:focus {
             outline: none !important;
             border-color: #4a90e2 !important;
             box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2) !important;
         }

         .filters button[type="submit"] {
             padding: 8px 16px;
             background-color: #4a90e2;
             color: white;
             border: none;
             border-radius: 4px;
             cursor: pointer;
             font-size: 14px;
             transition: background-color 0.3s;
         }

         .filters button[type="submit"]:hover {
             background-color: #3a7bc8;
         }

         .filters a {
             padding: 8px 16px;
             color: #4a90e2;
             text-decoration: none;
             border: 1px solid #4a90e2;
             border-radius: 4px;
             font-size: 14px;
             transition: all 0.3s;
         }

         .filters a:hover {
             background-color: #f0f7ff;
         }

         /* Responsive adjustments */
         @media (max-width: 768px) {
             .filters form {
                 flex-direction: column;
                 align-items: stretch;
             }

             .filters form>* {
                 width: 100%;
             }

             .filters .select2-container,
             .filters button,
             .filters a {
                 width: 100% !important;
             }
         }
              .filters form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }

        .filters label {
            font-weight: 600;
            color: #333;
            margin-right: 5px;
        }

        /* Select2 custom styles */
        .filters .select2-container {
            min-width: 200px;
        }

        .filters .select2-selection {
            padding: 6px 12px;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
            height: auto !important;
            font-size: 14px;
        }

        .filters .select2-selection:hover {
            border-color: #999 !important;
        }

        .filters .select2-selection:focus {
            outline: none !important;
            border-color: #4a90e2 !important;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2) !important;
        }

        .filters button[type="submit"] {
            padding: 8px 16px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .filters button[type="submit"]:hover {
            background-color: #3a7bc8;
        }

        .filters a {
            padding: 8px 16px;
            color: #4a90e2;
            text-decoration: none;
            border: 1px solid #4a90e2;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .filters a:hover {
            background-color: #f0f7ff;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .filters form {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filters form > * {
                width: 100%;
            }
            
            .filters .select2-container, 
            .filters button, 
            .filters a {
                width: 100% !important;
            }
        }
     </style>
 </head>

 <body>
     <!-- Add this near the top of your view file -->
     <div class="filters">
         <form method="get" action="">
             <label for="school">Filter by School:</label>
             <select name="school" id="school" class="js-select2">
                 <option value="">All Schools</option>
                 <?php foreach ($schools as $school): ?>
                     <option value="<?php echo $school; ?>" <?php echo $selectedSchool == $school ? 'selected' : ''; ?>>
                         <?php echo $school; ?>
                     </option>
                 <?php endforeach; ?>
             </select>

             <label for="year">Filter by Year:</label>
             <select name="year" id="year" class="js-select2">
                 <option value="">All Years</option>
                 <?php foreach ($years as $year): ?>
                     <option value="<?php echo $year; ?>" <?php echo $selectedYear == $year ? 'selected' : ''; ?>>
                         <?php echo $year; ?>
                     </option>
                 <?php endforeach; ?>
             </select>

             <button type="submit">Apply Filters</button>
             <?php if ($selectedSchool || $selectedYear): ?>
                 <a href="<?php echo $this->createUrl('allPoster'); ?>">Clear Filters</a>
             <?php endif; ?>
         </form>
     </div>





     <div class="projects-container">
         <?php foreach ($posters as $project): ?>
             <div class="project-card">

                 <h3 class="school-name">
                     <a href="?r=site/schoolDetails&project_id=<?php echo urlencode($project['project_id']); ?>" style="color: #2196f3; text-decoration: none;">
                         <?php echo htmlspecialchars($project['school_name'] . "  -- " . $project['mobarat_year']); ?>
                     </a>
                 </h3>
                 <p class="project-description"><?php echo htmlspecialchars($project['project_description']); ?></p>
                 <!-- <p class="project-description"><?php echo htmlspecialchars($project['mobarat_year']); ?></p> -->
             </div>
         <?php endforeach; ?>
     </div>

     <?php if ($totalPages > 1): ?>
         <nav data-pagination>
             <?php // Previous link 
                ?>
             <?php if ($page > 1): ?>
                 <a href="?r=site/allPoster&page=<?php echo $page - 1; ?>"><i class="ion-chevron-left"></i></a>
             <?php else: ?>
                 <a href="#" disabled><i class="ion-chevron-left"></i></a>
             <?php endif; ?>

             <ul>
                 <?php
                    // Always show first page
                    if ($page == 1): ?>
                     <li class="current"><a href="?r=site/allPoster&page=1">1</a></li>
                 <?php else: ?>
                     <li><a href="?r=site/allPoster&page=1">1</a></li>
                 <?php endif;

                    // Show pages around current page
                    $start = max(2, $page - 2);
                    $end = min($totalPages - 1, $page + 2);

                    if ($start > 2): ?>
                     <li><a href="#">…</a></li>
                 <?php endif;

                    for ($i = $start; $i <= $end; $i++): ?>
                     <?php if ($i == $page): ?>
                         <li class="current"><a href="?r=site/allPoster&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                     <?php else: ?>
                         <li><a href="?r=site/allPoster&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                     <?php endif; ?>
                 <?php endfor;

                    if ($end < $totalPages - 1): ?>
                     <li><a href="#">…</a></li>
                 <?php endif;

                    // Always show last page if different from first
                    if ($totalPages > 1): ?>
                     <?php if ($page == $totalPages): ?>
                         <li class="current"><a href="?r=site/allPoster&page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a></li>
                     <?php else: ?>
                         <li><a href="?r=site/allPoster&page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a></li>
                     <?php endif; ?>
                 <?php endif; ?>
             </ul>

             <?php // Next link 
                ?>
             <?php if ($page < $totalPages): ?>
                 <a href="?r=site/allPoster&page=<?php echo $page + 1; ?>"><i class="ion-chevron-right"></i></a>
             <?php else: ?>
                 <a href="#" disabled><i class="ion-chevron-right"></i></a>
             <?php endif; ?>
         </nav>
     <?php endif; ?>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    // Use jQuery's document ready to ensure DOM is fully loaded
    jQuery(document).ready(function($) {
        // Now we can safely use $
        $('.js-select2').select2({
            theme: 'bootstrap-5',
            width: 'style',
            placeholder: function() {
                return $(this).data('placeholder') || '';
            },
            allowClear: true
        });
    });
    </script>

 </body>

 </html>