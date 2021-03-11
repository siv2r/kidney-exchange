## General Guidelines
1. Be kind and respectful to the people involved since everyone contributes to this project in their free time.
2. Community members cannot answer your question right away (We are also college students like most of you 🤪) so, please be patient.
3. Do worry that there only 17 issues (Hence spamming all issue with **"Please assign this?"** 😵). All the problems with this project are not mentioned in the issues section so, this number will likely increase.
4. If you feel that none of the issue matches you interest, you can mention your ideas or any bugs you found while setting up this project by creating a new issue and start working on it.
5. It is not necessary that you need to be assigned to an issue to work on it. You can start working on it right away but let other members know by commenting on the issue. You can comment "I would like to work on this issue", "I would like to take a shot at this issue" insead of asking to be assigned.
6. Do not comment **"Please assign me this issue?"** in **all the issues pages**. This shows that you have not done any research to solve an issue and would not make a good impression with the mentors.
7. You are more likely to get a reply from the community members if your questions are related to this project. If have any questions related to the workings of Git/GitHub please google them there are ton of resources out there!!
8. If you run into any conflicts while rebasing your pull request, Feel free ask for help 🙂.
9. Please use a proper commit message. **Avoid commit messages like "some commit", "2nd commit", "updated branch", "commit"**.
10. Community members are not entitled to answer you since everyone contributes to this project in their free time so, please do your research (try to google your doubts) before asking any question.
11. **Avoid using "sir"** 😅 (We all are friends here!), you can just mention that person using '@'. 

## How do I start contributing to this project?
1. The easiest way is to contribute is through documentation. For example, there is no documentation for *Development workflow*, *FAQs*
2. To get more ideas on which type of documentation will be useful for this project. You can refer to the documentations of projects like [p5.js](https://github.com/processing/p5.js), [sympy](https://github.com/sympy/sympy)

## GIT AND GITHUB
***
Before continuing we want to clarify the difference between Git and Github. Git is a version control system(VCS) which is a tool to manage the history of our Source Code. GitHub is a hosting service for Git projects.

We assume you have created an account on Github and installed Git on your System.

Now tell Git your name and E-mail (used on Github) address.

``` $ git config --global user.name "YOUR NAME" ```
```$ git config --global user.email "YOUR EMAIL ADDRESS"```
This is an important step to mark your commits to your name and email.

### FORK A PROJECT -
***
You can use github explore - https://github.com/explore to find a project that interests you and match your skills. Once you find your cool project to workon, you can make a copy of project to your account. This process is called forking a project to your Github account. On Upper right side of project page on Github, you can see -

<p align="center">  <img  src="https://i.imgur.com/P0n6f97.png">  </p>

Click on fork to create a copy of project to your account. This creates a separate copy for you to workon.

### FINDING A FEATURE OR BUG TO WORKON - 
***
Open Source projects always have something to workon and improves with each new release. You can see the issues section to find something you can solve or report a bug. The project managers always welcome new contributors and can guide you to solve the problem. You can find issues in the right section of project page.

<p align="center">  <img  src="https://i.imgur.com/czVjpS7.png">  </p>

### CLONE THE FORKED PROJECT -
***
You have forked the project you want to contribute to your github account. To get this project on your development machine we use clone command of git.

```$ git clone https://github.com/<your-account-username>/<your-forked-project>.git```
Now you have the project on your local machine.

### ADD A REMOTE (UPSTREAM) TO ORIGINAL PROJECT REPOSITORY 
***
Remote means the remote location of project on Github. By cloning, we have a remote called origin which points to your forked repository. Now we will add a remote to the original repository from where we had forked.

```$ cd <your-forked-project-folder>```
```$ git remote add upstream https://github.com/<author-account-username>/<project>.git```
You will see the benefits of adding remote later.

### SYNCHRONIZING YOUR FORK -
***
Open Source projects have a number of contributors who can push code anytime. So it is necessary to make your forked copy equal with the original repository. The remote added above called Upstream helps in this.

```$ git checkout master```
```$ git fetch upstream```
```$ git merge upstream/master```
```$ git push origin master```
The last command pushes the latest code to your forked repository on Github. The origin is the remote pointing to your forked repository on github.

### CREATE A NEW BRANCH FOR A FEATURE OR BUGFIX -
***
Normally, all repositories have a master branch which is considered to remain stable and all new features should be made in a separate branch and after completion merged into master branch. So we should create a new branch for our feature or bugfix and start working on the issue.

```$ git checkout -b <feature-branch>```
This will create a new branch out of master branch. Now start working on the problem and commit your changes.

```$ git add --all```
```$ git commit -m "<commit message>"```
The first command adds all the files or you can add specific files by removing -a and adding the file names. The second command gives a message to your changes so you can know in future what changes this commit makes. If you are solving an issue on original repository, you should add the issue number like #35 to your commit message. This will show the reference to commits in the issue.

### REBASE YOUR FEATURE BRANCH WITH UPSTREAM-
***
It can happen that your feature takes time to complete and other contributors are constantly pushing code. After completing the feature your feature branch should be rebase on latest changes to upstream master branch.

```$ git checkout <feature-branch>```
```$ git pull --rebase upstream master```
Now you get the latest commits from other contributors and check that your commits are compatible with the new commits. If there are any conflicts solve them.

### SQUASHING YOUR COMMITS-
***
You have completed the feature, but you have made a number of commits which make less sense. You should squash your commits to make good commits.

```$ git rebase -i HEAD~5```
This will open an editor which will allow you to squash the commits.

### PUSH CODE AND CREATE A PULL REQUEST -
***
Till this point you have a new branch with the feature or bugfix you want in the project you had forked. Now push your new branch to your remote fork on github.

```$ git push origin <feature-branch>```
Now you are ready to help the project by opening a pull request means you now tell the project managers to add the feature or bugfix to original repository. You can open a pull request by clicking on green icon -

<p align="center">  <img  src="https://i.imgur.com/aGaqAD5.png">  </p>

Remember your upstream base branch should be master and source should be your feature branch. Click on create pull request and add a name to your pull request. You can also describe your feature.

Awesome! You have made your first contribution. If you have any doubts please let me know in the comments.

#### BE OPEN!

## Code contribution
- Black is used to format all the python codes.
- Phpfmt is used to format all the PHP codes
