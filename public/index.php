<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="./css/foundation.css"/>
    <link href="./css/hover.css" rel="stylesheet" type="text/css"/>
    <link href="./css/screen.css" rel="stylesheet" type="text/css"/>
    <link href="./css/print.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-route.min.js "></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="./js/app.js"></script>
    <script src="./js/controller.js"></script>
    <title>Blaks's Protofolio</title>
</head>
<body ng-app="mainApp">
<div ng-controller="mainController">
    <?php
    include "parse_all_info.php";
    require('../vendor/autoload.php');
    $parsed_info = new parse_all_info();
    $assignment0_info = $parsed_info->get_assignment("Assignment0");
    $assignment1_info = $parsed_info->get_assignment("Assignment1.0");
    $assignment1_1_info = $parsed_info->get_assignment("Assignment1.1");
    $assignment1_2_info = $parsed_info->get_assignment("Assignment1.2");
    $assignment2_info = $parsed_info->get_assignment("Assignment2.0");
    $assignment2_1_info = $parsed_info->get_assignment("Assignment2.1");
    $assignment3_info = $parsed_info->get_assignment("Assignment3");
    ?>


    <script type="text/javascript">
        var assignment1 = <?php echo json_encode($assignment1_info) ?>;
        var assignment1_1 = <?php echo json_encode($assignment1_1_info) ?>;
        var assignment1_2 = <?php echo json_encode($assignment1_2_info) ?>;
        var assignment0 = <?php echo json_encode($assignment0_info) ?>;
        var assignment2 = <?php echo json_encode($assignment2_info) ?>;
        var assignment2_1 = <?php echo json_encode($assignment2_1_info) ?>;
        var assignment3 = <?php echo json_encode($assignment3_info) ?>;
    </script>

    <div data-sticky-container>
        <nav id="navbar_desktop" class="top-bar sticky hide-for-small-only fullWidth" data-sticky data-margin-top="0">
            <ul id="Home" data-magellan data-magellan-target="Home" class="medium-horizontal menu">
                <li><a href="#Home">
                        <button id="HomeButton" class="button">Home</button>
                    </a></li>
                <li><a href="#About">
                        <button id="AboutButton" class="button">About</button>
                    </a></li>
                <li><a href="#Assignment1">
                        <button id="Assignment1Button" class="button">Assignment1</button>
                    </a></li>
                <li><a href="#Assignment2">
                        <button id="Assignment2Button" class="button">Assignment2</button>
                    </a></li>
                <li><a href="#Assignment3">
                        <button id="Assignment3Button" class="button">Assignment3</button>
                    </a></li>
            </ul>
        </nav>
        <nav id="navbar_mobile" class=" show-for-small-only top-bar-title fullWidth">
            <ul class="vertical menu" data-magellan data-accordion-menu>
                <li>
                    <a href="#">
                        <button><i class="fa fa-bars fa-2x"></i></button>
                    </a>
                    <ul class="menu vertical nested">
                        <li><a href="#Home" class="button">HOME</a></li>
                        <li><a class="button" href="#Assignment1">Assignment1</a></li>
                        <li><a class="button" href="#Assignment2">Assignment2</a></li>
                        <li><a class="button" href="#Assignment3">Assignment3</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div id="Home">

    </div>
    <div id="About" class="text-center oswald_type small-12">
        <h1>Welcome to Blaks's Portfolio page for CS242</h1>
        <h4>
            Hello, I am Blaks, and this site is currently under construction.
        </h4>
        <h4>
            Come by next week and you will find something amazing.
        </h4><h4> You can check all the codes I have written for these projects.
        </h4>
    </div>

    <div class="row project">
        <div class="media-object stack-for-small">
            <div class="media-object-section">
                <div class="thumbnail">
                    <img src="media/chess.png">
                </div>
            </div>
            <div class="media-object-section">
                <h4>Assignment 1: Chess game</h4>
                <p>A chess game is a games where you fight with your enemy, on the chess board.</p>
                <p>It is wriiten in Java</p>
            </div>
        </div>
        <ul class="vertical menu" data-accordion-menu>
            <li>
                <a href="#" id="Assignment1" class="small_head hvr-grow">Assignment 1</a>
                <ul class="menu vertical nested small-12">
                    <li ng-repeat="assign in assignment1">
                        <div>
                            <p><a data-open="modal1" class="hvr-grow">{{assign.name}} &nbsp Last
                                    Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                            <div class="reveal" id="modal1" data-reveal>
                                <h1>Awesome.</h1>
                                <button class="close-button" data-close aria-label="Close modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="vertical menu" data-accordion-menu>
            <li>
                <a href="#" id="Assignment1_1" class="small_head hvr-grow">Assignment 1.1</a>
                <ul class="menu vertical nested small-12">
                    <li ng-repeat="assign in assignment1_1">
                        <div>
                            <p><a data-open="modal1" class="hvr-grow">{{assign.name}} &nbsp Last
                                    Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                            <div class="reveal" id="modal1" data-reveal>
                                <h1>Awesome.</h1>
                                <button class="close-button" data-close aria-label="Close modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="vertical menu" data-accordion-menu>
            <li>
                <a href="#" id="Assignment1_2" class="small_head hvr-grow">Assignment 1.2</a>
                <ul class="menu vertical nested small-12">
                    <li ng-repeat="assign in assignment1_1">
                        <div>
                            <p><a data-open="modal1" class="hvr-grow">{{assign.name}} &nbsp Last
                                    Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                            <div class="reveal" id="modal1" data-reveal>
                                <h1>Awesome.</h1>
                                <button class="close-button" data-close aria-label="Close modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="row project">
        <div class="media-object stack-for-small text-center">
            <div class="media-object-section">
                <div class="thumbnail">
                    <img src="media/map.gif">
                </div>
            </div>
            <div class="media-object-section">
                <h4>Assignment 2: CSAIR interface</h4>
                <p>This is a interface written for CSAIR, a company coming from nowhere.</p>
                <p>It is written in Ruby</p>
            </div>
        </div>
        <ul class="vertical menu" data-accordion-menu>
            <li>
                <a href="#" id="Assignment2" class="small_head hvr-grow">Assignment 2</a>
                <ul class="menu vertical nested small-12">
                    <li ng-repeat="assign in assignment2">
                        <div>
                            <p><a data-open="modal1" class="hvr-grow">{{assign.name}} &nbsp Last
                                    Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                            <div class="reveal" id="modal1" data-reveal>
                                <h1>Awesome.</h1>
                                <button class="close-button" data-close aria-label="Close modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="vertical menu" data-accordion-menu>
            <li>
                <a href="#" id="Assignment2_1" class="small_head hvr-grow">Assignment 2.1</a>
                <ul class="menu vertical nested small-12">
                    <li ng-repeat="assign in assignment2">
                        <div>
                            <p><a data-open="modal1" class="hvr-grow">{{assign.name}} &nbsp Last
                                    Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                            <div class="reveal" id="modal1" data-reveal>
                                <h1>Awesome.</h1>
                                <button class="close-button" data-close aria-label="Close modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="row project">
        <div class="media-object stack-for-small text-center">
            <div class="media-object-section">
                <div class="thumbnail">
                    <img src="media/chess.png">
                </div>
            </div>
            <div class="media-object-section">
                <h4>Assignment 3: portfolio</h4>
                <p>Yes, you are currently looking at me</p>
                <p>I am wriiten in AngularJS, PHP, HTML and SASS</p>
                <p>Try seeing me on your mobile?</p>
            </div>
        </div>
        <ul class="vertical menu" data-accordion-menu>
            <li>
                <a href="#" id="Assignment3" class="small_head hvr-grow">Assignment 3</a>
                <ul class="menu vertical nested small-12">
                    <li ng-repeat="assign in assignment3">
                        <div>
                            <p><a data-open="modal1" class="hvr-grow">{{assign.name}} &nbsp Last
                                    Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                            <div class="reveal" id="modal1" data-reveal>
                                <h1>Awesome.</h1>
                                <button class="close-button" data-close aria-label="Close modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div ng-view></div>
<div></div>

<script src="./js/vendor/jquery.min.js"></script>
<script src="./js/vendor/what-input.min.js"></script>
<script src="./js/foundation.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>