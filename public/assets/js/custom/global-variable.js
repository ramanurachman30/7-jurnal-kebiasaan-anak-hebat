const personalToken = $('meta[name="token"]').attr('content');
const tokenCsrf = $('meta[name="token"]').attr('value');
const hostUrl = $('meta[name="hosturl"]').attr('content');
const uploadUri = $('meta[name="urlupload"]').attr('content');
const deleteFileUri = $('meta[name="deletefile"]').attr('content');
const assetDir = $('meta[name="assets"]').attr('content');
const firstSegmentUrl = $('meta[name="firstsegmenturl"]').attr('content');

function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
}

var guid = s4();