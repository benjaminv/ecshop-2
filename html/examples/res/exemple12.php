<?php
//WEBSC商城资源
$chaine = 'test de texte assez long pour engendrer des retours à la ligne automatique...';
$chaine .= ', répétitif car besoin d\'un retour à la ligne';
$chaine .= ', répétitif car besoin d\'un retour à la ligne';
$chaine .= ', répétitif car besoin d\'un retour à la ligne';
$chaine .= ', répétitif car besoin d\'un retour à la ligne';
echo "<style type=\"text/css\">\n<!--\nul\n{\n    background: #FFDDDD;\n    border: solid 1px #FF0000;\n}\n\nol\n{\n    background: #DDFFDD;\n    border: solid 1px #00FF00;\n}\n\nul li\n{\n    background: #DDFFAA;\n    border: solid 1px #AAFF00;\n}\n\nol li\n{\n    background: #AADDFF;\n    border: solid 1px #00AAFF;\n}\n-->\n</style>\n<page style=\"font-size: 11px\">\n    <ul style=\"list-style-type: disc; width: 80%\">\n        <li>\n            Point 1 :<br>";
echo $chaine;
echo "        </li>\n        <li>\n            Point 2 :<br>";
echo $chaine;
echo "            <ul style=\"list-style-type: circle\">\n                <li>\n                    Point 1 :<br>";
echo $chaine;
echo "                </li>\n                <li>\n                    Point 2 :<br>";
echo $chaine;
echo "                    <ul style=\"list-style-type: square\">\n                        <li>\n                            Point 1 :<br>";
echo $chaine;
echo "                        </li>\n                        <li>\n                            Point 2 :<br>";
echo $chaine;
echo "                        </li>\n                        <li>\n                            Point 3 :<br>";
echo $chaine;
echo "                            <ul style=\"list-style-image: url(./res/puce.gif)\">\n                                <li>\n                                    Puce en image 1 :<br>";
echo $chaine;
echo "                                </li>\n                                <li>\n                                    Puce en image 2 :<br>";
echo $chaine;
echo "                                </li>\n                                <li>\n                                    Puce en image 3 :<br>";
echo $chaine;
echo "                                </li>\n                            </ul>\n                        </li>\n                    </ul>\n                </li>\n                <li>\n                    Point 3 :<br>";
echo $chaine;
echo "                </li>\n            </ul>\n        </li>\n        <li>\n            Point 3 :<br>";
echo $chaine;
echo "        </li>\n    </ul>\n    <hr><hr>\n    <ol style=\"list-style-type: upper-roman\">\n        <li>\n            Point 1 :<br>";
echo $chaine;
echo "        </li>\n        <li>\n            Point 2 :<br>";
echo $chaine;
echo "            <ol style=\"list-style-type: lower-alpha\">\n                <li>\n                    Point 1 :<br>";
echo $chaine;
echo "                </li>\n                <li>\n                    Point 2 :<br>";
echo $chaine;
echo "                    <ol style=\"list-style-type: decimal\">\n                        <li>\n                            Point 1 :<br>";
echo $chaine;
echo "                        </li>\n                        <li>\n                            Point 2 :<br>";
echo $chaine;
echo "                        </li>\n                        <li>\n                            Point 3 :<br>";
echo $chaine;
echo "                        </li>\n                    </ol>\n                </li>\n                <li>\n                    Point 3 :<br>";
echo $chaine;
echo "                </li>\n            </ol>\n        </li>\n        <li>\n            Point 3 :<br>";
echo $chaine;
echo "        </li>\n    </ol>\n</page>";

?>
