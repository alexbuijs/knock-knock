import React, { useState } from 'react'
import ProfileForm from './ProfileForm'

const Profile = (data) => {
    const [userImage, setUserImage] = useState(data.photo)

    return (
        <>
            <div className="col-12 col-lg-8">
                <div className="card">
                    <div className="card-header bg-transparent"></div>
                    <div className="card-body">
                        <ProfileForm data={data} setUserImage={setUserImage} />
                    </div>
                    <div className="card-footer bg-transparent">
                        <small>Wil je je wachtwoord wijzigen? Dat kan <a href={data.profileLink}>hier</a>.</small>
                    </div>
                </div>
            </div>
            <div className="col-12 col-lg-4">
                <div className="card p-3">
                    <div className="profile-picture" style={{ backgroundImage: `url(${userImage})` }} ></div>
                </div>
            </div>
        </>
    )
}

export default Profile
