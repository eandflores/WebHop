# config valid only for Capistrano 3.1
lock '3.1.0'

set :application, 'Hop'
set :repo_url, 'git@bitbucket.com:eandres/hop.git'
set :scm, :git
set :branch, 'master'
set :use_sudo, true
set :user, 'root'
set :password, ''

role :app, 'root@localhost'
role :web, 'root@localhost'

server 'localhost', roles: [:web, :app], user: 'root'

set :stage, 'production'

set :format, :pretty
set :log_level, :debug
set :pty, true
set :linked_files, %w{app/Config/database.php .htaccess}

set :deploy_to, "/var/www/capistrano/Hop"

# Default value for linked_dirs is []
# set :linked_dirs, %w{bin log tmp/pids tmp/cache tmp/sockets vendor/bundle public/system}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

#set :keep_releases, 5

namespace :deploy do

  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
      execute "rm -rf /var/www/Hop/*"
      execute "chmod -R 777 #{deploy_to}/current"
      execute "cp -r #{deploy_to}/current/* /var/www/Hop"
      execute "chmod -R 777 /var/www/Hop"
      execute "cp -r #{deploy_to}/current/.htaccess /var/www/Hop"
      execute "cp -r #{deploy_to}/current/app/.htaccess /var/www/Hop/app"
      execute "cp -r #{deploy_to}/current/app/webroot/.htaccess /var/www/Hop/app/webroot"
      execute "service apache2 restart"
    end
  end

  after :publishing, :restart

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end

end
