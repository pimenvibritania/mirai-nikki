<template>
  <div>
      <h2>Table</h2>
      <hr>
      <table class="table">
          <thead>
              <tr>
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Published</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="note in notes" :key="note.id" >
                  <td><router-link :to="{name: 'notes.show', params: {noteSlug: note.slug, subjectSlug: note.subjectSlug}}" >{{note.title}}</router-link></td>
                  <td>{{note.subject}}</td>
                  <td>{{note.published}}</td>
                  <td>
                      <router-link :to="{name: 'notes.edit', params: {noteSlug: note.slug, subjectSlug: note.subjectSlug}}" class="btn btn-primary" >Edit</router-link>
                      | <delete-note :noteSlug="note.slug" :subjectSlug="note.subjectSlug" />
                    </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>

import axios from 'axios'
import DeleteNote from './Delete'

export default {
    components: {
        DeleteNote
    },
    data() {
        return{
            notes: [],
        }
    }, 
    
    mounted() {
        axios.get('/api/notes').then((response) => {
            this.notes = response.data.data;
        })
    }
}
</script>