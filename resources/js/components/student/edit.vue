 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Student</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Student Update
            <router-link to="/student" class="btn btn-sm btn-info" id="add_new"> All Student</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="studentUpdate" >
                <div class="form-group">
	                 <div class="form-row">
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.name" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
	                  <label for="name">Student Name</label>
	                </div>
	               </div>
                    <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.batch_name" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.batch_name">{{ errors.batch_name[0] }}</small>
	                  <label for="batch_name">Batch Name</label>
	                </div>
	               </div>

	             </div>
                 <div class="form-row">
                     <div class="col-md-6">
	                  <div class="form-group">
					    <label for="exampleFormControlSelect1">Department</label>
					    <select class="form-control" id="exampleFormControlSelect1" v-model="form.department_id">
					      <option :value="department.id" v-for="department in departments">{{ department.name }}</option>
					    </select>
					    <small class="text-danger" v-if="errors.department_id">{{ errors.department_id[0] }}</small>
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
        			batch_name :'',
        			department_id :'',

        		},
        		errors:{},
                departments:{}
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/student/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
            //department collected
        	axios.get('/api/department')
        	.then(({data}) => (this.departments = data))
        },
        methods:{
        	studentUpdate(){
        		let id = this.$route.params.id
        		axios.patch('/api/student/'+id,this.form)
        		.then(() => {
        			this.$router.push({ name: 'student' })
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
