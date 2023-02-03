<script setup>
</script>

<template>
  <router-link class="btn btn-outline-success" style="margin-bottom:20px;" to="/customer/add" tag="button">+ Add Customer</router-link>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Photo</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="c in customers">
        <td>{{c.id}}</td>
        <td>{{c.name}}</td>
        <td>{{c.email}}</td>
        <td>{{c.phone}}</td>
        <td>
           <img style="width:50px; height:50px" v-if="c.files.length > 0" :src="`http://localhost/storage/${c.files[0].uri}`"/>
        </td>
        <td>
          <div class="btn-group" role="group">
            <router-link :to="{name: 'edit-customer', params: { id: c.id }}" class="btn btn-success">Edit</router-link>
            <button class="btn btn-danger" @click="deleteCustomer(c.id)">Delete</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>

export default {
  data() {
    return {
      customers: []
    };
  },

  methods: {
    async getData() {
      try {
        const response = await this.$http.get(
          "http://localhost/api/customer"
        );
        // JSON responses are automatically parsed.
        this.customers = response.data.data;
      
      } catch (error) {
        console.log(error);
      }
    },
    deleteCustomer(id) {
      if (confirm('Deseja deletar o registro?')) {
        this.$http
              .delete('http://localhost/api/customer/'+id)
              .then(response => (
                  this.getData()
              ))
              .catch(err => console.log(err))
      }
    }
  },
  created() {
    this.getData();
  },
};
</script>

