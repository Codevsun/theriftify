# READ BEFORE MAKING CHANGES

## How to make changes after getting the PR reviewed

- Create a new branch for a new feature
  - Run `git checkout -b <branch_name>`
  - After making changes, run `git add .`
  - Run `git commit -m "message"`
  - Run `git push origin <branch_name>`
  - Open GitHub and click on `Compare & pull request`
  - Click on `Create pull request`
- Make changes in the same branch (after getting your PR reviewed by me):
  - Run `git add .`
  - Run `git commit --amend --no-edit`
  - Run `git push -f`
- To rebase with the main branch (if your branch is behind the main branch, meaning there are new changes in the main branch that you don't have in your branch)
  - Run `git pull origin main`
  - Run `git rebase main`
