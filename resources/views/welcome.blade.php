@extends('layout')
@section('content')
        <div id="root" class="container">

            <!--<game-card class="game-card" v-for="game in games" :game="game"></game-card>-->
            <article class="message is-info">
                <div class="message-header">
                    <p>Doel van de applicatie</p>
                </div>
                <div class="message-body">
                    <p>Welkom op mijn gaming library APP!</p>
                    <p> Deze app is bedoeld voor eigen gebruik om een overzicht te krijgen van mijn games & whishlist op een leuke en orderlijke manier! Via de IGDB ben ik in staat om de belangrijkste info mee tegeven, terwijl ik zelf weinig info moet opzoeken (versimpelt mijn werk aan het verleden). Naast het tonen van games, kan ook elke game voorzien worden van een eigen score om mijn eigen voorkeuren te tonen.<p>
                </div>
            </article>

            <article class="message is-warning">
                <div class="message-header">
                    <p>BUGS & TODO's</p>
                </div>
                <div class="message-body">
                    <h3>Bugs</h3>
                    <ul>
                        <li> navbar werkt nog niet juist (qua layout & functionaliteit)</li>
                    </ul>
                    <br>
                    <h3>TO DO</h3>
                    <ul>
                        <li> - implementeren van wishlist functionaliteit</li>
                        <li> - implementeren van bewerk & verwijder functionaliteit</li>
                        <li> - implementeren van play_list</li>
                    </ul>
                </div>
            </article>

        </div>
        <script src="https://unpkg.com/vue@2.6.11/dist/vue.js" ></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection

