 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Department</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Department Update
            <router-link to="/department" class="btn btn-sm btn-info" id="add_new"> All Department</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="departmentUpdate" >
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.name" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
	                  <label for="name">Department Name</label>
	                </div>
	               </div>

	             </div>
	          </div>

               <button type="submit" class="btn btn-success">Update</button>
              </form>
          </div>

         </div>
       </div>
   </div>
</template>

<script>

    export default {
    	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            }
        },
        data(){
        	return{
        		form:{
        			name :'',

        		},
        		errors:{},
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/department/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
        },
        methods:{
        	departmentUpdate(){
        		let id = this.$route.params.id
        		axios.patch('/api/department/'+id,this.form)
        		.then(() => {
        			this.$router.push({ name: 'department' })
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        	},

        }


    }




</script>

<style>

#add_new{
	float: right;
}

</style>
