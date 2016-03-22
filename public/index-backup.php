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
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="./js/app.js"></script>
    <script src="./js/controller.js"></script>
    <title>Blaks's Protofolio</title>
</head>

<body ng-app="mainApp">
<div ng-controller="mainController">


    <a href="#/assignment/1" class="button"> Assignment</a>
    <a href="#/home" class="button">Home</a>
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
    <!--
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
                                <p><a data-open="modal1" class="hvr-grow" ng-model="Hisname" value="{{assign.name}}">{{assign.name}}
                                        &nbsp Last
                                        Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp
                                        Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                                <div class="reveal" id="modal1" data-reveal>
                                    <h1>Awesome.{{Hisname}}</h1>
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
                                        Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp
                                        Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
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
                                        Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp
                                        Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
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
                                        Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp
                                        Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
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
                                        Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp
                                        Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
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
                            <p><a data-open="{{assign.name}}" class="hvr-grow">{{assign.name}} &nbsp Last
                                    Version:{{assign.last_revision}} &nbsp Commit at: {{assign.last_date}} &nbsp
                                    Filetype: {{assign.kind}} &nbsp Size: {{assign.size}}</a></p>
                            <a class="reveal" id="{{assign.name}}" data-reveal>
                                <h1>{{assign.size}}</h1>
                                <button class="close-button" data-close aria-label="Close modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>-->
</div>

<div class="row">
    <div class="small-12">
        <div ng-view></div>
    </div>
</div>

<script src="./js/vendor/jquery.min.js"></script>
<script src="./js/vendor/what-input.min.js"></script>
<script src="./js/foundation.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>


