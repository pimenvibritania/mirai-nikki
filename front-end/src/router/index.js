import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home'
import About from "@/views/About"
import Contact from "@/views/Contact"
import CreateNotes from "@/views/notes/Create"
import NoteTable from "@/views/notes/NoteTable";
import Show from "@/views/notes/Show";
import Edit from "@/views/notes/Edit";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/about',
    name: 'pages.about',
    component: About
  },
  {
    path: '/contact',
    name: 'pages.contact',
    component: Contact
  },
  {
    path: '/notes/create',
    name: 'notes.create',
    component: CreateNotes
  },
  {
    path: '/notes',
    name: 'notes',
    component: NoteTable
  },
  {
    path: '/notes/:subjectSlug/:noteSlug',
    name: 'notes.show',
    component: Show
  },
  {
    path: '/notes/:subjectSlug/:noteSlug/edit',
    name: 'notes.edit',
    component: Edit
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
