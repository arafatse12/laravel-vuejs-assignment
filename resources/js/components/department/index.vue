 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Department</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Department Insert
            <router-link to="/store-department" class="btn btn-sm btn-info" id="add_new"> Add New</router-link>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive">
                <label>Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="department in filtersearch" :key="department.id">
                      <td>{{ department.name }}</td>
                      <td>
                        <router-link :to="{name: 'edit-department', params:{id: department.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteDepartment(department.id)" class="btn btn-sm btn-danger">Delete</a>
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
        this.allDepartment();
        },

        data(){
          return{
            departments:[],
            searchTerm:'',
          }
        },
       computed:{
         filtersearch(){
          return this.departments.filter(department => {
             return department.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allDepartment(){
            axios.get('/api/department/')
            .then(({data}) => (this.departments = data))
            .catch()
          },
          deleteDepartment(id){
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
              axios.delete('/api/department/'+id)
              .then(()=>{
                 this.departments = this.departments.filter(department =>{
                    return department.id !=id
                 })
              })
              .catch(()=>{
                 this.$router.push({name: 'department'})
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
