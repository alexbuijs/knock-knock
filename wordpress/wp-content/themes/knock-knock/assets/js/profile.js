import React from 'react'
import ReactDOM from 'react-dom'
import domReady from '@wordpress/dom-ready'

import Profile from './components/Profile'

domReady(function () {
    const root = document.getElementById('react-root')
    ReactDOM.render(<Profile {...(root.dataset)} />, root)
})

/* import 'whatwg-fetch'
import 'bootstrap/js/dist/alert'
import 'promise.prototype.finally'

export default (form) => {
  if (!form) {
    return
  }

  // Alert
  const alert = form.querySelector('.alert')
  const showAlert = (message, type = 'success') => {
    alert.innerText = message
    alert.classList.remove('d-none')
    alert.classList.remove('alert-success', 'alert-danger', 'alert-warning')
    alert.classList.add('alert-' + type)
  }

  const hideAlert = () => {
    alert.classList.add('d-none')
  }

  const submitButton = form.querySelector('button[type="submit"]')
  const pictureEl = document.getElementById('profile-picture')

  const setLoading = (isLoading) => {
    submitButton.disabled = isLoading

    if (isLoading) {
      submitButton.querySelector('.spinner-border').classList.remove('d-none')
      submitButton.querySelector('.body').innerHTML = 'Even geduld...'
      hideAlert()
    } else {
      submitButton.querySelector('.spinner-border').classList.add('d-none')
      submitButton.querySelector('.body').innerHTML = 'Opslaan'
    }
  }

  submitButton.addEventListener('click', e => {
    e.preventDefault()
    setLoading(true)

    const data = new window.FormData(form)

    const fileInput = form.querySelector('input[type="file"]')
    data.append(fileInput.getAttribute('name'), fileInput.files[0])

    window.fetch(window.ajax.url, {
      method: 'POST',
      body: data
    }).then(response => response.json())
      .then(response => {
        if (response.success) {
          showAlert(response.data.message)
          if (response.data.image) {
            pictureEl.style.backgroundImage = 'url(' + response.data.image + ')'
          }
        } else {
          showAlert(response.data ? response.data : 'Er ging iets mis.', 'danger')
          console.error(response)
        }
      }).finally(() => {
        setLoading(false)
      })
  })
}
*/
