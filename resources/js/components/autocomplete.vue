<template>
 <div>
   <div class="input-group">
     <b-form-input type="text" v-model="search" placeholder="Search for a city" v-on:keyup="getSearchData" class="form-control"></b-form-input>
     <span class="input-group-btn">
         <button type="submit" class="btn btn-default" @click="getResult(search)">
             <span class="fa fa-search"></span>
         </button>
     </span>
   </div>

   <div class="panel-footer" v-if="results.length" >
     <div class="dropdown" v-for="result in results" aria-haspopup="true" aria-expanded="false">
         <a class="dropdown-item"><li class="dropdown-item" @click="getResult(result)" hide-no-data hide-selected>{{ result.name }}</li></a>
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
          this.results = response.data;
         });
       }
    },
    getResult(result){
      console.log(result.name);
      if(this.search.length < 1 ){
        console.log("Error");
      } else{
        this.getSearchData();
      }

      if(result !== null) {
        // this.onclick = true;
        this.$router.replace({name: 'searchIndex', params: { city: result.name }});
        // this.search = '';
        // this.onclick = false;
      }
      // this.onclick = false;
      // this.search = "";
    },

  },
  computed: {
  }
}
</script>
