Vue.component('game-card',{

    props: {
        game:{
            type: Object,
        }
    },
    template:`
<div class="card">
  <div class="card-image">
    <figure class="image">
      <img :src="game.game.attributes.art_url" alt="Placeholder image">
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
        <p class="title is-4"><a :href="game.game.attributes.url">{{game.game.attributes.name}}</a></p>
        <p class="subtitle is-6">developer: {{game.developer.attributes.name}}</p>
        <p class="subtitle is-6">publisher: {{game.publisher.attributes.name}}</p>
        <!--<p v-if="game.game.relations.franchise" class="subtitle is-6">franchise: {{game.game.relations.franchise.name}}</p>-->
        <p class="subtitle is-6">jaar: {{game.game.attributes.release_date}}</p>
        <p class="subtitle is-6">platform: {{game.game.attributes.platform}}</p>
        <ul class="subtitle is-6" id="inline-list">
        <li>genres: </li>
        <li v-for="genre in game.game.relations.genres"> {{genre.name}}, </li>
        </ul>
      </div>
     </div>
    <div class="content">
      <p>{{game.game.attributes.summary}}</p>

      <p class="title is-6">Scores</p>
      <ul>
      <li>average rating : <b>{{game.game.attributes.total_rating}}</b> </li>
      <li>personal rating : <b>{{game.game.attributes.myScore}}</b></li>
      </ul>
      <br>

      <div class="screenshots">
        <div class="screenshot">
          <img :src="this.screenshot" alt="Placeholder image">
        </div>
        <div class="screenshot">
          <img :src="this.screenshot2" alt="Placeholder image">
        </div>
      </div>

      <!--<story-toggle>{{game.game.attributes.summary}}</story-toggle>-->
    </div>
  </div>
</div>
    `,


    data() {
        return {
            link: "https://images.igdb.com/igdb/image/upload/t_cover_big/" + this.game.game.relations.cover.image_id + ".jpg",
            screenshot: "https://images.igdb.com/igdb/image/upload/t_original/" + this.game.screenshot1.attributes.image_id + ".jpg",
            screenshot2: "https://images.igdb.com/igdb/image/upload/t_original/" + this.game.screenshot2.attributes.image_id + ".jpg",
            //genres: this.game.relations.genres,
        };
    },

    methods: {
        make_screenshot(){

        }
    }

});

Vue.component('story-toggle',{
    props: 'gameID',
    template:`
            <div>
                <p>
                    <button class="button" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        summary
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-block">
                        <slot></slot>
                    </div>
                </div>
            </div>

    `,
});

new Vue({
    el: '#root',
    data: {
        games: [],
    },

    created(){
        axios.get('/get_games')
            .then(response => {
                this.games = response.data
            })
    },

})
