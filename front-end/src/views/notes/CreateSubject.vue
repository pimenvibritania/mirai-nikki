<template>
  <a @click="newSubject" class="btn btn-primary form-control col-md-3">New</a>
</template>

<script>
import axios from 'axios'

export default {

  methods: {
    async newSubject(){

      let sub = {
        'name': ''
      }
      this.$swal.fire({
        title: 'Submit your Github username',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: async(newSubject) => {
          try {
            sub.name = newSubject
            let response = await axios.post('/api/subjects/new-subject', sub )
            if (response.status == 200) {
              return response.data.message
            }
          }catch (e) {
            this.$swal.showValidationMessage(
                `Request failed: ${e} , ${newSubject}`
            )
          }
        },
        allowOutsideClick: () => this.$swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          this.$swal.fire({
            icon: "success",
            title: "Your subject added",
            showConfirmButton: false,
            timer: 3000
          })
          this.$router.go(this.$router.currentRoute)

        }
      })
    }
  }
}
</script>