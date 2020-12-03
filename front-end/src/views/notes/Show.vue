<template>
  <div>
      <h1>[<i>{{note.subject}}</i>] {{note.title}}</h1>
      <hr>
      <h4>{{note.description}}</h4>
      <br>
      <p><i>{{note.published}}</i></p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
    data(){
        return{
            note: []
        }
    },

    mounted(){
        this.getNote()
    },

    methods: {
        async getNote() {
            let response = await axios.get('/api/notes/'+ this.$route.params.subjectSlug + '/'+ this.$route.params.noteSlug)
            this.note = response.data.data
        }
    }
}
</script>