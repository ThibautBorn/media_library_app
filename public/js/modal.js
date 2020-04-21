Vue.component('modal-details', {
    props: ['game', 'developer','publisher','screenshot1','screenshot2'],
    template: `

        <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <button class="modal-default-button" @click="$emit('close')">
                OK
              </button>
          </div>

          <div class="modal-body">
          <!---------------------------MODAL INHOUD------------------------------------------------------------------------------------->
          <div class="card-image">
    <figure class="image">
      <img :src="game.attributes.art_url" alt="Placeholder image">
      <!--<img :src="this.art" alt="Placeholder image">-->
    </figure>
  </div>
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-128x128">
          <img :src="this.link" alt="Placeholder image">
        </figure>
      </div>
      <br>
      <div class="media-content">
        <p class="title is-4"><a :href="game.attributes.url">{{game.attributes.name}}</a></p>
        <p class="subtitle is-6">developer: {{developer.attributes.name}}</p>
        <p class="subtitle is-6">publisher: {{publisher.attributes.name}}</p>
        <!--<p v-if="game.game.relations.franchise" class="subtitle is-6">franchise: {{game.game.relations.franchise.name}}</p>-->
        <p class="subtitle is-6">jaar: {{game.attributes.release_date}}</p>
        <p class="subtitle is-6">platform: {{game.attributes.platform}}</p>
        <ul class="subtitle is-6" id="inline-list">
        <li>genres: </li>
        <li v-for="genre in game.relations.genres"> {{genre.name}}, </li>
        </ul>
      </div>
     </div>
    <div class="content">
      <p>{{game.attributes.summary}}</p>

      <p class="title is-6">Scores</p>
      <ul>
      <li>average rating : <b>{{game.attributes.total_rating}}</b> </li>
      <li>personal rating : <b>{{game.attributes.myScore}}</b></li>
      </ul>
      <br>

      <div class="screenshots">
        <div class="screenshot">
          <img :src="this.screenshot" alt="Placeholder image">
        </div>
        <div class="screenshot">
          <img :src="this.screenshotTwo" alt="Placeholder image">
        </div>
      </div>

      <!--<story-toggle>{{game.game.attributes.summary}}</story-toggle>-->
    </div>
  </div>
  <!---------------------------MODAL INHOUD------------------------------------------------------------------------------------->


          </div>

        </div>
      </div>
    </div>
  </transition>

    `,

    data() {
        return {
            link: "https://images.igdb.com/igdb/image/upload/t_cover_big/" + this.game.relations.cover.image_id + ".jpg",
            screenshot: "https://images.igdb.com/igdb/image/upload/t_original/" + this.screenshot1.attributes.image_id + ".jpg",
            screenshotTwo: "https://images.igdb.com/igdb/image/upload/t_original/" + this.screenshot2.attributes.image_id + ".jpg",
            //genres: this.game.relations.genres,
        };
    },

});

Vue.component('game', {
    props: {
        game:{
            type: Object,
        }
    },

    data() {
        return {
            showModal: false,
        }
    },

    template: `
              <!--
              <div>
                <button id="show-modal" @click="showModal = true">{{game.game.attributes.name}}</button>
                -->

                <tr>
                <td><button id="show-modal" @click="showModal = true">{{game.game.attributes.name}}</button></td>
                <td>{{game.game.attributes.release_date}}</td>
                <td>{{game.game.attributes.platform}}</td>
                <td>{{game.game.attributes.myScore}}</td>
                <modal-details v-if="showModal" @close="showModal = false" :game="game.game" :developer="game.developer" :publisher="game.publisher" :screenshot1="game.screenshot1" :screenshot2="game.screenshot2"></modal-details>
                </tr>

                <!--

            </div>
            -->

    `
});

Vue.component('game-table', {
    props: {
        games:Array,
    },

    data() {
        return {

        }
    },

    template: `
<div>
<button @click="activateData">avtiveer datatables</button>
<table id="tabel-games" class="display">
        <thead>
        <tr>
            <th width="25%">Titel</th>
            <th width="25%">jaar</th>
            <th width="25%">platform</th>
            <th width="25%">Eigen Score</th>
        </tr>
        </thead>
        <tbody>

        <game v-for="game in games" :key="game.game.attributes.name" :game="game"/>

        </tbody>
    </table>
    </div>

    `,

    methods:{
        activateData(){
            $(document).ready(function() {
                $('#tabel-games').DataTable();
            } );
        }
    },

    mounted(){

    }
});


new Vue({
    el: '#root',
    data: {
        games: [],
    },

    methods: {
        itemClicked: function(game) {
            this.name = game.game.attributes.name;
            this.score = game.game.attributes.name;
            $("#my-modal").modal('show');
        }
    },

    created(){
        axios.get('/get_games')
            .then(response => {
                this.games = response.data
            })
    },

})
