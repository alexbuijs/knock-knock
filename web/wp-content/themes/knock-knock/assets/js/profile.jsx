import React from 'react'
import ReactDOM from 'react-dom'
import domReady from '@wordpress/dom-ready'

import Profile from './components/Profile'

domReady(function () {
    const root = document.getElementById('react-root')
    ReactDOM.render(<Profile {...(root.dataset)} />, root)
})
