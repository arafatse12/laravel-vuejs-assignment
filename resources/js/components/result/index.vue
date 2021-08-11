 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Result</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Result Insert
            <router-link to="/store-result" class="btn btn-sm btn-info" id="add_new"> Add New</router-link>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive">
                <label>Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Department Name</th>
                      <th>Gpa</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>

                    <tr v-for="result in filtersearch" :key="result.id">
                      <td>{{ result.student_name }}</td>
                      <td>{{ result.department_name }}</td>
                      <td>{{ result.gpa }}</td>
                      <td>{{ result.date }}</td>
                      <td>
                        <router-link :to="{name: 'edit-result', params:{id: result.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteResult(result.id)" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
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

        created(){
        this.allResult();
        },

        data(){
          return{
            results:[],
            searchTerm:'',
          }
        },
       computed:{
         filtersearch(){
          return this.results.filter(result => {
             return result.student_name.toLowerCase().match(this.searchTerm) || result.student_name.match(this.searchTerm) || result.department_name.toLowerCase().match(this.searchTerm) || result.department_name.match(this.searchTerm) || result.gpa.match(this.searchTerm)
           })
         }
       },
        methods:{
          allResult(){
            axios.get('/api/result/')
            .then(({data}) => (this.results = data))
            .catch()
          },
          deleteResult(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              axios.delete('/api/result/'+id)
              .then(()=>{
                 this.results = this.results.filter(result =>{
                    return result.id !=id
                 })
              })
              .catch(()=>{
                 this.$router.push({name: 'result'})
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
           })
          }
        },

    }



</script>

<style>

#add_new{
	float: right;
}
#em_photo{
  height: 40px;
  width: 40px;
}

</style>
