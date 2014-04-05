# config valid only for Capistrano 3.1
lock '3.1.0'

set :application, 'Hop'
set :repo_url, 'git@bitbucket.com:eandres/hop.git'
set :scm, :git
set :branch, 'master'
set :use_sudo, false

role :app, 'root@192.168.1.126'
role :web, 'root@192.168.1.126'

server '192.168.1.126', roles: [:web, :app], user: 'root'

set :stage, 'production'

set :format, :pretty
set :log_level, :debug
set :pty, true
set :linked_files, %w{app/Config/database.php}

set :deploy_to, "/var/www/Hop"

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
      run "service apache2 restart"
    end
  end

  after :publishing, :restart

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
      run "cp #{deploy_to}/current/* #{deploy_to}"
    end
  end

end
