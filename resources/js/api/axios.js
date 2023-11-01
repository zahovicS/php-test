// First we need to import axios.js
import axios from 'axios'
const base_url = document.querySelector('meta[name="base-url"]').content

// Next we make an 'instance' of it
const instance = axios.create({
  // .. where we make our configurations
  baseURL: base_url,
})

// Where you would set stuff like your 'Authorization' header, etc ...
instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

// Also add/ configure interceptors && all the other cool stuff

export default instance
