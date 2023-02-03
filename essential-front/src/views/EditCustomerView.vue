<script setup>
</script>

<template>
  <div class="form">
    <h3>Edit Customer</h3>
    <div v-if="error.length > 0" class="alert alert-danger" role="alert">
        <ul>
          <li v-for="message in error">
              {{message}}
          </li>
        </ul>
    </div>
    <form @submit.prevent="editCustomer">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" required v-model="customer.name" placeholder="Enter customer name">
      </div>
      <div class="form-group">
        <label for="email">Mail</label>
        <input type="email" class="form-control" required v-model="customer.email" placeholder="Enter customer email">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="phone" class="form-control" required v-model="customer.phone" placeholder="Enter customer phone with ddd format ex : (99)9999-9999">
      </div>
      <FileUpload :maxSize="5" accept="jpg,jpeg,png" @file-uploaded="fileUploaded"/>
      <div class="form-group">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>
</template>

<style>
  .form {
      width: 500px;
      margin: auto;
      margin-top: 20px;
  }
</style>
<script>

import FileUpload from "@/components/FileUpload.vue";

export default {
  data() {
    return {
      customer: {
        files: []
      },
      error: []
    }
  },
  components: {
    FileUpload
  },
  methods: {
      editCustomer() {
        this.$http
            .put(`http://localhost/api/customer/${this.$route.params.id}`, this.customer)
            .then(response => (
                this.$router.push({ name: 'customer' })
            ))
            .catch(err => 
                this.error = err.response.data.message
            )
            .finally(() => this.loading = false)
      
    },
    fileUploaded(file) {
      this.customer.files.unshift(file);
    }
  },
  created() {
      this.$http
          .get(`http://localhost/api/customer/${this.$route.params.id}`)
          .then((res) => {
              this.customer = res.data.data;
          });
  }
};
</script>

