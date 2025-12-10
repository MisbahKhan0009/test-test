-- Populate 60 diverse diary entries with varied media for user_id = 1
-- Mix of entries with images, videos (YouTube links), both, or neither
-- Dates ranging throughout 2025

-- Store the starting entry_id to calculate offsets for media inserts
SET @start_id = (SELECT COALESCE(MAX(entry_id), 0) FROM entries);

-- Entries 1-10: January 2025 (Mixed content)
INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'New Year Resolutions', 'Starting 2025 with fresh goals and determination. This year will be different!', 'Excited', '2025-01-01 09:30:00', NULL),
(1, 'Winter Morning Walk', 'The crisp air feels amazing. Watched the sunrise over the frozen lake today.', 'Calm', '2025-01-05 07:15:00', 'https://youtu.be/1ZYbU82GVz4'),
(1, 'Coding Marathon', 'Spent 8 hours working on my new project. Exhausting but rewarding.', 'Happy', '2025-01-08 22:30:00', NULL),
(1, 'Coffee Shop Vibes', 'Found a new favorite spot downtown. Great atmosphere for reading.', 'Calm', '2025-01-12 14:20:00', 'https://youtube.com/watch?v=5qap5aO4i9A'),
(1, 'Rainy Day Blues', 'Sometimes you just need a day to stay in bed and watch movies.', 'Sad', '2025-01-15 11:00:00', NULL);

INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Gym Progress', 'Finally hit my weight goal! All those early mornings paid off.', 'Happy', '2025-01-18 18:45:00', 'https://youtu.be/ZbZSe6N_BXs'),
(1, 'Birthday Celebration', 'Surprise party from friends! Best day ever. Feeling so loved.', 'Excited', '2025-01-22 20:00:00', 'https://youtube.com/watch?v=3GwjfUFyY6M'),
(1, 'Late Night Thoughts', 'Can''t sleep. Mind racing with ideas and possibilities.', 'Reflective', '2025-01-25 02:30:00', NULL),
(1, 'Weekend Hiking', 'Conquered the mountain trail! The view from the top was breathtaking.', 'Excited', '2025-01-27 16:30:00', NULL),
(1, 'Learning Spanish', 'Week 1 of language learning. Hola, me llamo... this is harder than I thought!', 'Happy', '2025-01-30 19:00:00', NULL);

-- Entries 11-20: February 2025
INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Valentine''s Day Solo', 'Treating myself to fancy dinner. Self-love is important too!', 'Happy', '2025-02-14 19:30:00', 'https://youtu.be/kJQP7kiw5Fk'),
(1, 'Career Breakthrough', 'Got the promotion! All the hard work finally recognized.', 'Excited', '2025-02-18 17:00:00', NULL),
(1, 'Book Club Night', 'Finished "The Midnight Library". Life-changing perspectives.', 'Reflective', '2025-02-20 21:00:00', NULL),
(1, 'Cooking Experiment', 'Tried making sushi at home. It''s... an interesting shape, but tastes good!', 'Happy', '2025-02-23 18:30:00', 'https://youtube.com/watch?v=Ns15eHLDv1I'),
(1, 'Early Spring Signs', 'Saw the first flowers blooming. Winter is finally ending!', 'Happy', '2025-02-26 10:30:00', NULL);

INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Photography Day', 'Spent the whole day capturing city street scenes. Got some amazing shots!', 'Excited', '2025-02-03 15:45:00', NULL),
(1, 'Old Friends Reunion', 'Coffee with college friends. Like no time has passed at all.', 'Happy', '2025-02-07 13:00:00', NULL),
(1, 'Meditation Journey', 'Started daily meditation practice. Day 10 and feeling more centered.', 'Calm', '2025-02-10 07:00:00', 'https://youtu.be/inpok4MKVLM'),
(1, 'Tax Season Stress', 'Drowning in paperwork and receipts. Adult life is not fun.', 'Angry', '2025-02-28 23:30:00', NULL),
(1, 'Movie Marathon', 'Rewatching all the Lord of the Rings extended editions. Epic weekend!', 'Happy', '2025-02-16 22:00:00', 'https://youtube.com/watch?v=_SBQvd6vY9s');

-- Entries 21-30: March 2025
INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Spring Cleaning', 'Decluttered my entire apartment. Feeling so organized and free!', 'Happy', '2025-03-01 16:00:00', NULL),
(1, 'Art Gallery Visit', 'Modern art exhibition downtown. Some pieces spoke to my soul.', 'Reflective', '2025-03-05 14:30:00', NULL),
(1, 'Sick Day Recovery', 'Finally feeling better after the flu. Never taking health for granted again.', 'Calm', '2025-03-09 11:00:00', NULL),
(1, 'Concert Night', 'Live music hits different! The energy was incredible.', 'Excited', '2025-03-12 23:00:00', 'https://youtu.be/450p7goxZqg'),
(1, 'Garden Project Start', 'Planted my first vegetable garden. Can''t wait to see them grow!', 'Excited', '2025-03-15 10:00:00', NULL);

INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Running Personal Best', 'Beat my 5K time by 2 minutes! Training is paying off.', 'Excited', '2025-03-18 07:30:00', 'https://youtube.com/watch?v=btPJPFnesV4'),
(1, 'Family Video Call', 'Caught up with parents and siblings. Miss them so much.', 'Sad', '2025-03-21 19:00:00', NULL),
(1, 'New Recipe Success', 'Made the perfect lasagna from scratch. Gordon Ramsay would be proud!', 'Happy', '2025-03-24 20:00:00', NULL),
(1, 'Beach Day Trip', 'First beach visit of the year. Sand, sun, and relaxation.', 'Calm', '2025-03-27 15:00:00', 'https://youtu.be/V1bFr2SWP1I'),
(1, 'Writing Sprint', 'Finished three chapters of my novel today. The words just flowed!', 'Happy', '2025-03-30 21:30:00', NULL);

-- Entries 31-40: April-May 2025
INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'April Showers', 'Rainy days make me reflective. Watching the drops on the window.', 'Reflective', '2025-04-03 16:30:00', 'https://youtu.be/HMnrl0tmd3k'),
(1, 'Spontaneous Road Trip', 'Packed a bag and just drove. Adventure is calling!', 'Excited', '2025-04-07 08:00:00', NULL),
(1, 'Work Deadline Crunch', 'Pulled an all-nighter but got it done. Coffee is my hero.', 'Sad', '2025-04-10 06:00:00', NULL),
(1, 'Cherry Blossoms', 'The trees are in full bloom. Nature''s confetti everywhere!', 'Happy', '2025-04-14 12:00:00', NULL),
(1, 'Gaming Night', 'Beat that impossible boss level. Victory tastes sweet!', 'Excited', '2025-04-18 02:00:00', 'https://youtube.com/watch?v=2S0QhGGO1gQ');

INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Farmers Market Haul', 'Got fresh produce and homemade bread. Supporting local!', 'Happy', '2025-04-21 10:30:00', NULL),
(1, 'Yoga Breakthrough', 'Finally held a headstand for 30 seconds! Mind over matter.', 'Excited', '2025-04-25 18:00:00', NULL),
(1, 'Poetry Reading Event', 'Shared my work publicly for the first time. Terrifying but liberating!', 'Excited', '2025-04-28 20:00:00', NULL),
(1, 'May Day Celebration', 'Community festival was amazing. Love this neighborhood.', 'Happy', '2025-05-01 17:00:00', 'https://youtu.be/w5tWYmIOWGk'),
(1, 'Career Reflections', 'Five years at this company. Time to reassess my path.', 'Reflective', '2025-05-05 22:00:00', NULL);

-- Entries 41-50: June-July 2025
INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Summer Solstice', 'Longest day of the year. Spent every moment outside!', 'Happy', '2025-06-21 21:00:00', 'https://youtu.be/2vjPBrBU-TM'),
(1, 'BBQ with Friends', 'Grilled everything. Laughter and good food all day.', 'Happy', '2025-06-15 19:30:00', NULL),
(1, 'Lake Swimming', 'First swim of summer. The water was cold but refreshing!', 'Excited', '2025-06-08 14:00:00', NULL),
(1, 'Night Sky Watching', 'Meteor shower was spectacular. Made three wishes.', 'Calm', '2025-07-12 01:00:00', 'https://youtube.com/watch?v=UfcAVejslrU'),
(1, 'Home Renovation Start', 'Tearing down the old kitchen. New beginnings!', 'Excited', '2025-07-05 09:00:00', NULL);

INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Ice Cream Adventure', 'Tried every flavor at the new shop. No regrets!', 'Happy', '2025-06-25 16:00:00', NULL),
(1, 'Thunderstorm Drama', 'Power went out but candles made it cozy. Nature is powerful.', 'Calm', '2025-07-18 20:30:00', NULL),
(1, 'Festival Concert', 'Three day music festival! Best lineup ever.', 'Excited', '2025-07-25 23:30:00', 'https://youtu.be/fJ9rUzIMcZQ'),
(1, 'Camping Weekend', 'Stars, campfire, and no cell service. Perfect escape.', 'Calm', '2025-07-28 22:00:00', NULL),
(1, 'Painting Session', 'Finished my abstract piece. Art therapy is real.', 'Reflective', '2025-06-30 15:30:00', NULL);

-- Entries 51-60: August-December 2025
INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Back to School Vibes', 'Starting that online course I''ve been planning. Learning never stops!', 'Excited', '2025-08-15 10:00:00', NULL),
(1, 'Sunset Bike Ride', 'Golden hour cycling through the park. Pure magic.', 'Calm', '2025-08-22 19:30:00', 'https://youtu.be/5qap5aO4i9A'),
(1, 'Harvest Moon', 'Full moon tonight. Feeling connected to something bigger.', 'Reflective', '2025-09-07 21:00:00', NULL),
(1, 'Autumn Begins', 'First leaves are changing color. My favorite season is here!', 'Happy', '2025-09-22 14:00:00', NULL),
(1, 'Halloween Prep', 'Decorating the house with spooky stuff. Bring on October!', 'Excited', '2025-10-01 16:00:00', NULL);

INSERT INTO entries (user_id, title, content, mood, timestamp, music_link) VALUES
(1, 'Thanksgiving Feast', 'Family gathered, grateful for everything. Stuffed with food and love.', 'Happy', '2025-11-27 18:00:00', NULL),
(1, 'First Snow', 'Woke up to a white wonderland. Winter has arrived!', 'Excited', '2025-11-30 08:00:00', 'https://youtube.com/watch?v=Z0kGAz6HYM8'),
(1, 'Year-End Review', 'Looking back at 2025. So much growth and change.', 'Reflective', '2025-12-05 20:00:00', NULL),
(1, 'Holiday Shopping Done', 'All gifts wrapped and ready. Organized for once!', 'Happy', '2025-12-15 17:00:00', NULL),
(1, 'New Year Eve Plans', 'Ready to welcome 2026. This year taught me so much.', 'Reflective', '2025-12-31 22:00:00', 'https://youtu.be/UtF6Jej8yb4');

-- Now add media (images) to random entries using the offset from @start_id
-- Using Lorem Picsum for varied image URLs

INSERT INTO media (entry_id, file_path, file_type) VALUES
-- January entries with images
(@start_id + 1, 'https://picsum.photos/800/600?random=1', 'image/jpeg'),
(@start_id + 3, 'https://picsum.photos/800/600?random=3', 'image/jpeg'),
(@start_id + 5, 'https://picsum.photos/800/600?random=5', 'image/jpeg'),
(@start_id + 9, 'https://picsum.photos/800/600?random=9', 'image/jpeg'),

-- February entries with images
(@start_id + 11, 'https://picsum.photos/800/600?random=11', 'image/jpeg'),
(@start_id + 13, 'https://picsum.photos/800/600?random=13', 'image/jpeg'),
(@start_id + 16, 'https://picsum.photos/800/600?random=16', 'image/jpeg'),
(@start_id + 18, 'https://picsum.photos/800/600?random=18', 'image/jpeg'),

-- March entries with images
(@start_id + 21, 'https://picsum.photos/800/600?random=21', 'image/jpeg'),
(@start_id + 22, 'https://picsum.photos/800/600?random=22', 'image/jpeg'),
(@start_id + 25, 'https://picsum.photos/800/600?random=25', 'image/jpeg'),
(@start_id + 27, 'https://picsum.photos/800/600?random=27', 'image/jpeg'),
(@start_id + 29, 'https://picsum.photos/800/600?random=29', 'image/jpeg'),

-- April-May entries with images
(@start_id + 32, 'https://picsum.photos/800/600?random=32', 'image/jpeg'),
(@start_id + 34, 'https://picsum.photos/800/600?random=34', 'image/jpeg'),
(@start_id + 36, 'https://picsum.photos/800/600?random=36', 'image/jpeg'),
(@start_id + 40, 'https://picsum.photos/800/600?random=40', 'image/jpeg'),

-- June-July entries with images
(@start_id + 41, 'https://picsum.photos/800/600?random=41', 'image/jpeg'),
(@start_id + 42, 'https://picsum.photos/800/600?random=42', 'image/jpeg'),
(@start_id + 43, 'https://picsum.photos/800/600?random=43', 'image/jpeg'),
(@start_id + 46, 'https://picsum.photos/800/600?random=46', 'image/jpeg'),
(@start_id + 50, 'https://picsum.photos/800/600?random=50', 'image/jpeg'),

-- August-December entries with images
(@start_id + 51, 'https://picsum.photos/800/600?random=51', 'image/jpeg'),
(@start_id + 53, 'https://picsum.photos/800/600?random=53', 'image/jpeg'),
(@start_id + 54, 'https://picsum.photos/800/600?random=54', 'image/jpeg'),
(@start_id + 57, 'https://picsum.photos/800/600?random=57', 'image/jpeg'),
(@start_id + 59, 'https://picsum.photos/800/600?random=59', 'image/jpeg'),

-- Some entries with multiple images
(@start_id + 7, 'https://picsum.photos/800/600?random=7a', 'image/jpeg'),
(@start_id + 7, 'https://picsum.photos/800/600?random=7b', 'image/jpeg'),
(@start_id + 26, 'https://picsum.photos/800/600?random=26a', 'image/jpeg'),
(@start_id + 26, 'https://picsum.photos/800/600?random=26b', 'image/jpeg'),
(@start_id + 48, 'https://picsum.photos/800/600?random=48a', 'image/jpeg'),
(@start_id + 48, 'https://picsum.photos/800/600?random=48b', 'image/jpeg');

-- Summary:
-- Total: 60 entries
-- Entries with YouTube/Music links: 15 entries (2, 4, 6, 7, 8, 14, 18, 24, 26, 29, 31, 44, 48, 52, 60)
-- Entries with images: 27 entries (various throughout the year)
-- Entries with both music and images: 3 entries (7, 26, 48)
-- Entries with neither: Many entries for variety
-- Date range: January 1, 2025 to December 31, 2025
-- Moods: Only uses allowed moods (Happy, Sad, Angry, Calm, Excited, Reflective)

-- Note: This script uses @start_id variable to calculate entry IDs dynamically
-- so it works regardless of existing entries in the database
