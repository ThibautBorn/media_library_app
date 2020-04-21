<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//stijl.kuleuven.be/2016/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">

    <title>Library App</title>

    <!-- Styles -->
    <style>
        .game-card {
            padding: 1em;
            margin-top: 1em;
            max-width: 800px;
        }

        .collapse.show{
            display: block;

        }

        .subtitle:not(.is-spaced)+.subtitle {
            margin-top: -1rem;
        }

        ul#inline-list li {
            display: inline;
        }

        .screenshots::after {
            content: "";
            clear: both;
            display: table;
        }

        .screenshot{
            width: 46%;
            height: auto;
            float: left;
            padding: 5px

        }

        /*****
        Begin MODAL ----------------------------------------------------------------------------------------------------------------
         */

        .modal-mask {
            position: fixed;
            z-index: 9998;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: table;
            transition: opacity 0.3s ease;
        }

        .modal-wrapper {
            display: table-cell;
            vertical-align: middle;
        }

        .modal-container {
            width: 45em;
            height: 90%;
            overflow-y: auto;
            margin: 0px auto;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
            transition: all 0.3s ease;
            font-family: Helvetica, Arial, sans-serif;
        }

        .modal-header h3 {
            margin-top: 0;
            color: #42b983;
        }

        .modal-body {
            margin: 20px 0;
        }

        .modal-default-button {
            float: right;
        }

        /*
         * The following styles are auto-applied to elements with
         * transition="modal" when their visibility is toggled
         * by Vue.js.
         *
         * You can easily play with the modal transition by editing
         * these styles.
         */

        .modal-enter {
            opacity: 0;
        }

        .modal-leave-active {
            opacity: 0;
        }

        .modal-enter .modal-container,
        .modal-leave-active .modal-container {
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }

        /**
        EINDE MODAL ----------------------------------------------------------------------------------------------------------------
         */

    </style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<header>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <!-- <a class="navbar-item" href="https://www.clipartkey.com/mpngs/m/96-962384_controller-gamepad-video-games-computer-game-icon-blue.png">-->
            <a href="https://www.clipartkey.com/mpngs/m/96-962384_controller-gamepad-video-games-computer-game-icon-blue.png">
                <img src="https://www.gamalive.com/images/une/28188-lionhead-studios-fermeture-peter-molyneux-fable-black-and-white-30042016030203.jpg" width="112" height="28">
            </a>

        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="{{route('welcome')}}">
                    Home
                </a>

                <a class="navbar-item" href="{{route('list_games')}}">
                    My Games
                </a>

                <a class="navbar-item" href="{{route('create_game')}}">
                    add game
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Whishlist
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            add game to wishlist
                        </a>
                        <a class="navbar-item">
                            niets
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</header>
@yield('content')
</body>
</html>
