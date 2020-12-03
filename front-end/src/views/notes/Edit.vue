
<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">New Note</div>
          <div class="card-body">
            <form action="#" method="post" @submit.prevent="update">
              <div class="form-group">
                <label for="title">Title</label>
                <input
                  type="text"
                  v-model="form.title"
                  id="title"
                  class="form-control"
                />
                <div v-if="theErrors.title" class="mt-2 text-danger"> *{{ theErrors.title[0] }}</div>
              </div>
              <div class="form-group">
                <label for="title">Subject</label>
                <select
                  @change="selectedSubject"
                  id="subject"
                  class="form-control"
                >
                <option :value="form.subjectId" v-text="form.subject" ></option>
                <template v-for="subject in subjects" >
                    <option v-if="subject.id !== form.subjectId" :key="subject.id" :value="subject.id">
                        {{subject.name}}
                    </option>
                </template>
                    
                </select>
                <div v-if="theErrors.subject" class="mt-2 text-danger"> *{{ theErrors.subject[0] }}</div>
              </div>
              <div class="form-group">
                <label for="title">Description</label>
                <textarea v-model="form.description" id="description" rows="5" class="form-control"></textarea>
                <div v-if="theErrors.description" class="mt-2 text-danger"> *{{ theErrors.description[0] }}</div>

              </div>
              <button type="submit" class="btn btn-primary" >Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      form: [],
      
      subjects: [],

      theErrors: [],

      selected: ''
    };
  },

  mounted() {
    this.getSubjects();
    this.getNote();
  },

  methods: {
    async getSubjects() {
      let response = await axios.get("/api/subjects");

      if (response.status == 200) {
        this.subjects = response.data;
      }
    },

    async getNote() {
        let response = await axios.get(`/api/notes/${this.$route.params.subjectSlug}/${this.$route.params.noteSlug}`)
        this.form = response.data.data
    },

    selectedSubject(e) {
       this.selected = e.target.value
    }, 

    async update(){
      try {
        this.form['subject'] = this.selected || this.form.subjectId

        let response = await axios.patch(`/api/notes/${this.$route.params.subjectSlug}/${this.$route.params.noteSlug}/edit`, this.form)

        if (response.status == 200) {
          this.$toasted.show(response.data.message, {
              type: 'success',
              duration: 3000
            })
          
          this.$router.push('/notes')
        }
      } catch (e) {
        this.$toasted.show("Something went wrong", {
            type: 'error',
            duration: 3000
          })
          this.theErrors = e.response.data.errors;
      }
  }
  }

  
};
</script>