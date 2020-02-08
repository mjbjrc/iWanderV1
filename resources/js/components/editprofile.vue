<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              EDIT PROFILE
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              <form v-on:submit.prevent="updateImage"  enctype="multipart/form-data">
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="name">Name</label>
                      <input id="name" type="text" v-model="name" class="form-control" name="name" required autocomplete="name" autofocus>
                  </div>
                </div>
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="email">Email</label>
                      <input id="email" v-model="email" type="email" class="form-control" name="email" required autocomplete="email">
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="password">Password</label>
                      <input id="password" v-model="password" type="password" class="form-control" name="password" required autocomplete="password">
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <div class="custom-file">
                          <input type="file" @change="newImage" name="image" class="custom-file-input" id="image">
                          <label class="custom-file-label" for="image">Profile Image</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-0 justify-content-center">
                      <div class="col-md-8 text-center">
                          <button type="submit" @click="$emit('close')" class="btn btn-primary buttons">
                              Save
                          </button>
                          <button @click="$emit('close')" class="btn btn-primary buttons">
                              Close
                          </button>
                      </div>
                  </div>
              </form>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
export default{
  name: 'editprofile',
  components: {},
  data(){
    return{
        name: '',
        email: '',
        password: '',
        image: ''
    }
  },
  methods:{
    newImage(){
      let files = event.target.files;
      console.log(files);

      if(file.length){
        this.image = files[0];
        // console.log("ERROR");
      }
    },
    updateImage(){
      let app = this;
      // let data = new FormData();
      // data.append('file',this.image);
      // data.append('_method','put');
      axios.put('/api/profile', {
        name: app.name,
        email: app.email,
        password: app.password,
        image: app.image
        // data
      })
      .then(res => {
        console.log(res);
      })
      .catch(function(error){
          console.log(error);
      });
    }
  }
}
</script>
<style>
</style>
