 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Result</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Result Insert
            <router-link to="/result" class="btn btn-sm btn-info" id="add_new"> All Result</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="resultInsert" >
                <div class="form-group">
	              <div class="form-row">
                   <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.gpa" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.gpa">{{ errors.gpa[0] }}</small>
	                  <label for="gpa">Gpa</label>
	                </div>
	               </div>
                   <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="date" v-model="form.date" class="form-control"  required="">
	                  <label for="date"> Date</label>
	                  <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>
	                </div>
	               </div>
	                <br>
	             </div>
                 <div class="form-row">
                     <div class="col-md-4">
	                  <div class="form-group">
					    <label for="exampleFormControlSelect1">Student</label>
					    <select class="form-control" id="exampleFormControlSelect1" v-model="form.student_id">
					      <option :value="student.id" v-for="student in students">
                              {{ student.name }}</option>
					    </select>
					    <small class="text-danger" v-if="errors.student_id">{{ errors.student_id[0] }}</small>
					  </div>
	               </div>
                 </div>
	          </div>
               <button type="submit" class="btn btn-success">Submit</button>
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
        			gpa :'',
        			date:''
        		},
        		errors:{},
                students:{},
        	}
        },


        methods:{
        	resultInsert(){
        		axios.post('/api/result/',this.form)
        		.then(() => {
        			this.$router.push({ name: 'result' })
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        	},

        },
         created(){
        	axios.get('/api/student')
        	.then(({data}) => (this.students = data))

        },


    }

</script>

<style>

#add_new{
	float: right;
}

</style>
