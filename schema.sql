-- MySQL schema for Diary App
-- Run this in phpMyAdmin or MySQL client

CREATE DATABASE IF NOT EXISTS `diary_app` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `diary_app`;

-- Users table
CREATE TABLE IF NOT EXISTS users (
  user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(100) NULL,
  date_of_birth DATE NULL,
  profile_pic VARCHAR(255) NULL,
  password_hash VARCHAR(255) NOT NULL,
  security_question VARCHAR(255) NULL,
  security_answer VARCHAR(255) NULL
) ENGINE=InnoDB;

-- Entries table
CREATE TABLE IF NOT EXISTS entries (
  entry_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  title VARCHAR(150) NOT NULL,
  content TEXT NOT NULL,
  mood VARCHAR(30) NULL,
  timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_entries_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Media table
CREATE TABLE IF NOT EXISTS media (
  media_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  entry_id INT UNSIGNED NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  file_type VARCHAR(50) NOT NULL,
  CONSTRAINT fk_media_entry FOREIGN KEY (entry_id) REFERENCES entries(entry_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Indexes for performance
CREATE INDEX idx_entries_user ON entries(user_id);
CREATE INDEX idx_entries_timestamp ON entries(timestamp);
CREATE INDEX idx_entries_title ON entries(title);
CREATE INDEX idx_media_entry ON media(entry_id);

-- Sample Data: Create a demo user (password is "demo123")
INSERT INTO users (username, full_name, date_of_birth, password_hash, security_question, security_answer) VALUES
('demo_user', 'Alex Morgan', '1995-06-15', '$2y$10$YGq3H9Z5fKjV8xN2QwE7/.vM4pKjHxJ5fKjV8xN2QwE7vM4pKjHxJu', 'What is your favorite color?', '$2y$10$favoritecolor123hash');

-- Sample Entries: 30 diverse diary entries
INSERT INTO entries (user_id, title, content, mood, timestamp) VALUES
(1, 'First Day of Summer', 'Today marked the beginning of summer vacation. The weather was absolutely perfect - warm sunshine, gentle breeze. I spent the afternoon at the beach with friends, collecting seashells and watching the sunset. Life feels good right now.', 'happy', '2024-06-21 14:30:00'),
(1, 'Morning Reflections', 'Woke up early today and took a long walk in the park. The morning dew, the chirping birds, everything felt so peaceful. Sometimes I forget how beautiful simple moments can be. Need to do this more often.', 'peaceful', '2024-06-25 07:15:00'),
(1, 'Challenging Day at Work', 'Work was intense today. Multiple deadlines, difficult clients, and technical issues. Felt overwhelmed for most of the day. But I managed to push through and deliver everything on time. Proud of myself for not giving up.', 'stressed', '2024-07-02 18:45:00'),
(1, 'Coffee Shop Discoveries', 'Found this amazing little coffee shop downtown. The ambiance is perfect - cozy lighting, great music, and the best latte I have had in months. Spent 3 hours there just reading and people-watching. Definitely my new favorite spot.', 'content', '2024-07-08 16:20:00'),
(1, 'Family Reunion', 'The whole family got together today for a barbecue. Saw cousins I had not seen in years. We laughed, shared stories, and made new memories. These moments remind me how important family is. Feeling grateful.', 'joyful', '2024-07-14 19:00:00'),
(1, 'Rainy Day Thoughts', 'It has been raining all day. Something about rainy days makes me introspective. Spent the day listening to old music, looking through photo albums, thinking about how much has changed over the years.', 'nostalgic', '2024-07-20 11:30:00'),
(1, 'Fitness Milestone', 'Finally hit my fitness goal! Been working out consistently for 3 months and the results are showing. Ran 5 miles today without stopping. I feel stronger and more confident than ever.', 'accomplished', '2024-07-25 06:45:00'),
(1, 'Late Night Creativity', 'Could not sleep so I stayed up sketching. There is something magical about late night creativity - no distractions, just me and my thoughts flowing onto paper. Created something I am actually proud of.', 'inspired', '2024-08-01 02:20:00'),
(1, 'Unexpected News', 'Got some unexpected news today that changed my plans for the next few months. Feeling a mix of emotions - anxious about the change but also excited about new possibilities. Change is scary but necessary.', 'anxious', '2024-08-05 20:15:00'),
(1, 'Sunday Brunch Bliss', 'Perfect Sunday brunch with my best friends. Pancakes, mimosas, endless laughter. These are the people who make life worth living. Grateful for friendships that feel like family.', 'grateful', '2024-08-11 12:00:00'),
(1, 'Learning Something New', 'Started learning guitar today. My fingers hurt and I sound terrible, but I am excited. Always wanted to do this. It is never too late to start something new.', 'motivated', '2024-08-18 15:30:00'),
(1, 'Quiet Evening In', 'Sometimes the best evenings are the quiet ones. Made myself dinner, watched an old favorite movie, and just relaxed. No plans, no pressure, just being.', 'relaxed', '2024-08-23 21:00:00'),
(1, 'Mountain Hike Adventure', 'Conquered that hiking trail I have been wanting to try. The view from the top was breathtaking. Four hours of climbing but totally worth it. Nature has a way of putting everything in perspective.', 'energized', '2024-08-29 17:45:00'),
(1, 'Book Club Discussion', 'Book club tonight was amazing. We had such deep discussions about the themes and characters. I love being part of a group that values literature and meaningful conversation.', 'engaged', '2024-09-03 22:30:00'),
(1, 'Baking Experiments', 'Tried baking sourdough bread for the first time. It took all day but the results were incredible! There is something deeply satisfying about creating food from scratch. Already planning my next baking project.', 'satisfied', '2024-09-10 19:15:00'),
(1, 'Concert Night', 'Went to an incredible concert tonight. The energy of the crowd, the music vibrating through my chest, singing along to every word - pure magic. These are the experiences that make you feel alive.', 'ecstatic', '2024-09-15 23:45:00'),
(1, 'Garden Progress', 'My little garden is finally flourishing! The tomatoes are ripening, the herbs smell amazing, and the flowers are blooming. There is something therapeutic about nurturing plants and watching them grow.', 'proud', '2024-09-21 10:30:00'),
(1, 'Challenging Conversation', 'Had a difficult but necessary conversation today. It was uncomfortable but needed to happen. Sometimes growth comes from difficult moments. Feeling emotionally drained but relieved.', 'reflective', '2024-09-26 16:00:00'),
(1, 'Autumn Beginnings', 'First day of fall and the leaves are starting to change colors. Went for a drive through the countryside - the scenery was like a painting. Fall has always been my favorite season.', 'peaceful', '2024-10-01 14:20:00'),
(1, 'Cooking Class Fun', 'Took a cooking class today and learned to make authentic pasta from scratch. Met some interesting people and ate amazing food. Definitely want to do more of these.', 'excited', '2024-10-07 20:00:00'),
(1, 'Childhood Memories', 'Found old childhood photos today while cleaning. Spent hours going through them, remembering simpler times. It is amazing how a single photo can transport you back in time.', 'nostalgic', '2024-10-12 13:45:00'),
(1, 'Volunteer Day', 'Volunteered at the local shelter today. Met so many incredible people with inspiring stories. Reminded me that small acts of kindness can make a big difference. Feeling humbled and grateful.', 'fulfilled', '2024-10-18 17:30:00'),
(1, 'Art Gallery Visit', 'Spent the afternoon at the new art exhibition downtown. Some pieces moved me to tears. Art has this incredible power to make you feel and think deeply about life.', 'moved', '2024-10-24 15:00:00'),
(1, 'Game Night Laughs', 'Board game night with friends was hilarious. We laughed until our stomachs hurt. Sometimes you just need an evening of pure fun and silliness with people who get you.', 'amused', '2024-10-30 22:15:00'),
(1, 'Early Morning Yoga', 'Started my day with sunrise yoga on the beach. The combination of movement, breath, and ocean sounds was transcendent. Feeling centered and ready for whatever the day brings.', 'zen', '2024-11-05 06:30:00'),
(1, 'Project Completion', 'Finally finished that project I have been working on for months. The sense of accomplishment is overwhelming. All those late nights and early mornings were worth it. Time to celebrate!', 'triumphant', '2024-11-11 19:45:00'),
(1, 'Cozy Winter Evening', 'First really cold day of the season. Made hot chocolate, lit candles, wrapped myself in a blanket and just enjoyed the coziness. Sometimes simple pleasures are the best.', 'cozy', '2024-11-18 20:30:00'),
(1, 'Unexpected Kindness', 'A stranger did something incredibly kind for me today, completely unexpected. It restored my faith in humanity. Planning to pay it forward soon.', 'touched', '2024-11-23 12:00:00'),
(1, 'Planning Future Adventures', 'Spent the evening planning my dream vacation. Looking at destinations, making lists, dreaming big. Even just the planning process fills me with excitement. Life is an adventure waiting to happen.', 'hopeful', '2024-11-28 21:00:00'),
(1, 'Reflecting on Growth', 'Looking back at where I was a year ago versus where I am now. So much has changed. I have grown in ways I never expected. Proud of my journey and excited for what is next.', 'proud', '2024-12-03 18:00:00');
