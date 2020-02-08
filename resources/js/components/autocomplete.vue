<template>
 <div>
   <div class="input-group">
     <b-form-input type="text" v-model="search" placeholder="Search for a city" v-on:keyup="getSearchData" class="form-control"></b-form-input>
     <span class="input-group-btn">
         <button type="submit" class="btn btn-default">
             <span class="fa fa-search"></span>
         </button>
     </span>
   </div>

   <div class="panel-footer" v-if="results.length" >
     <div class="dropdown" v-for="result in results" aria-haspopup="true" aria-expanded="false">
         <a class="dropdown-item"><li class="dropdown-item" @click="getResult(result)">{{ result.name }}</li></a>
     </div>
   </div>

 </div>
</template>
<script>
 export default{
   name: 'autocomplete',
  props: ['app'],
  data(){
   return {
    search: '',
    results: [],
    // onclick: false
   }
  },
  methods: {
    getSearchData(){
        this.results = [];
        if(this.search.length > 0){
         axios.get('/api/search',{params: {search: this.search}}).then(response => {
          this.results = response.data.slice(0,1);
          // return app.results.slice(0,8)
         });
       }
    },
    getResult(result){
      this.search = '';
      this.results = '';
      console.log(result.name);
      this.$router.replace({name: 'searchIndex', params: { city: result.name }});
      window.location.reload();

    }

  },
  computed: {
  }
}
</script>
