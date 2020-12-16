
function UI() {

}
UI.prototype.clickImageBtn = function (el) {
    el.click();
}
//event listener
if (window.location.pathname == '/projects/connect/dashboard.php') {
    const imageBtn = document.querySelector('.image-file');
    document.querySelector('.image-upload').addEventListener('click', () => {
        const ui = new UI();
        ui.clickImageBtn(imageBtn);
    });
}

function Github() {
    this.clietId = "7d086a1e14d479f93f36";
    this.clientSecret = "a92c2a727e9f12bd7e3f0f8c67d5aebe99591072";
    this.repos_count = 6;
    this.repos_sort = 'created:asc';
}
Github.prototype.getRepos = async function (user) {
    const repoResponse = await fetch(`https://api.github.com/users/${user}/repos?&per_page=${this.repos_count}&sort=${this.repos_sort}&client_id=${this.client_id}&client_secret=${this.client_secret}`);
    const repos = await repoResponse.json();
    return {
        repos: repos
    }
}
UI.prototype.showRepos = function (repos) {
    let output = '';
    repos.forEach(repo => {
        output += `
      <div class="jumbotron py-1 mt-0">
      <div class="row">
          <div class="col-md-9">
              <a href="${repo.html_url}"><h6 class="primary-color mt-3">${repo.name}</h6></a>
              <p class="mt-0 py-0">${repo.description}</p>
          </div>
          <div class="col-md-3">
              <div class="d-flex flex-column justify-content-center text-center">
                  <div class="badge px-2 mt-4 button-two">
                      Stars : ${repo.stargazers_count}
                  </div>
                  <div class="badge bg-dark text-white px-2 mt-2">
                      Watchers :${repo.watchers_count}
                  </div>
                  <div class='badge px-2 mt-2'>
                      Fork : ${repo.forks_count}
                  </div>
              </div>
          </div>
      </div>
   </div>
      `
    })
    document.querySelector('.repos-container').innerHTML = output;
}
function displayRepos() {
    const username = document.querySelector('.githubname').value;
    const git = new Github();
    if (username !== '') {
        git.getRepos(username).then(data => {
            const ui = new UI();
            ui.showRepos(data.repos);
        });

    }

}
displayRepos();
