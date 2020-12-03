<template>
    <button ref="deleteNote" @click="destroyNote" class="btn btn-danger">Delete</button>
</template>

<script>
import axios from 'axios'

export default {
    props: [
        'noteSlug', 'subjectSlug'
    ],
    methods: {
        async destroyNote() {
          this.$swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(async(result) => {
            if (result.isConfirmed) {
              let response = await axios.delete(`/api/notes/${this.subjectSlug}/${this.noteSlug}/delete`)

              if (response.status == 200) {
                this.$swal.fire({
                  icon: 'success',
                  title: "Note was Deleted",
                  showConfirmButton: false,
                  timer: 3000
                })

                this.$refs.deleteNote.parentNode.parentNode.remove()
              }
            }
          })

        }
    }
}
</script>