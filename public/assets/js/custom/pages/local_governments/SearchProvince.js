const fetching = (url, headers) => {
    return new Promise(async (resolve, reject) => {
        const response = await fetch(url, {
            headers
        });
        const {
            status
        } = response;
        if (status === 200) {
            return resolve(response.json());
        }
        return reject(response.json());
    });
}

$(document).on('keyup', '.search-province', delay(async function (e) {
    e.preventDefault();
    const search = this.value;
    $('.search-province').val(search);
    const baseUrl = document.getElementsByName('base-url');
    const {
        content
    } = baseUrl[0];

    const url = `${content}/api/get_provinces/${search}`;
    const headers = {
        Authorization: "Bearer {{ session('bearer_token') }}"
    }

    const data = await fetching(url, headers);

    if (data.length > 0) {
        let currentUrl = document.getElementById('url');
        var dom = `<ul id="ul" class = "list-group list-group-flush p-y-2 p-x-2">`;
        for (let index = 0; index < data.length; index++) {
            const element = data[index];
            const {
                province
            } = element;

            dom += `<hr style="border: 0.5px solid #FFFFFF;">
                    <a href="${currentUrl.value}/${province.slug}" class="p-y-1" barba-prevent-default>
                        <div class="card-local-gov p-x-1 p-y-1 ">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-white">
                                    ${province.title.toUpperCase()}
                                </p>
                                <span class="text-white icon-olarrow"></span>
                            </div>
                        </div>
                    </a>
                `;
        }

        dom += `</ul>`;

        const target1 = document.getElementById('scroll-y-gov');
        const target2 = document.getElementById('scroll-y-gov-2');
        target1.innerHTML = dom;
        target2.innerHTML = dom;
    }
}, 500));

function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}