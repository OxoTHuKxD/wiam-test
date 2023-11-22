let inProcess = false;

function processAcceptButton()
{
    if(inProcess) {
        return;
    }
    inProcess = true;
    let acceptButton = document.getElementById("accept-button");
    fetch('/images/' + acceptButton.dataset.imageId + '/save-result/accept', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': yii.getCsrfToken(),
        }
    }).then(function (response) {
        if (response.ok) {
            return response.json();
        }
        return Promise.reject(response);
    }).then(function (data) {
        successProcessButton(data);
    }).catch(function (err) {
        return err.json();
    }).then(function (data) {
        console.log(data);
        inProcess = false;
    })
}

function processRejectButton()
{
    if(inProcess) {
        return;
    }
    inProcess = true;
    let rejectButton = document.getElementById("reject-button");
    fetch('/images/' + rejectButton.dataset.imageId + '/save-result/reject', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': yii.getCsrfToken(),
        }
    }).then(function (response) {
        if (response.ok) {
            return response.json();
        }
        return Promise.reject(response);
    }).then(function (data) {
        successProcessButton(data);
    }).catch(function (err) {
        return err.json();
    }).then(function (data) {
        console.log(data);
        inProcess = false;
    })
}

function successProcessButton(data) {
    document.getElementById("accept-button").dataset.imageId = data.imageId;
    document.getElementById("reject-button").dataset.imageId = data.imageId;
    document.getElementById("main-image").src = data.imageUrl;
    inProcess = false;
}