mins = 0.3

import tkinter as tk
import importlib
import threading
from time import sleep
from math import floor
from tkinter import filedialog
from os import listdir, unlink
from os.path import isfile, join
from shutil import copy

root = tk.Tk()

main_path = filedialog.askdirectory()

def run():
    bot_path = './bots'

    for file in listdir(bot_path):
        file_loc = join(bot_path, file)
        if isfile(file_loc):
            unlink(file_loc)
            
    for dir in listdir(main_path):
        dir_loc = join(main_path, dir)
        if not isfile(dir_loc):
            for file in listdir(dir_loc):
                file_loc = join(dir_loc, file)
                if isfile(file_loc):
                    copy(file_loc, bot_path)
                    
    game = importlib.import_module('main')
    while 1:
        print('t')
        game.loop()
        if game.get_winner() is not None:
            break
    print('e')
    for _ in range(100):
        sleep(0.1)
    print('n')
    game.quit_game()
    del game
    
class Timer:
    def __init__(self, parent):
        self.seconds = int(mins * 60)
        self.label = tk.Label(parent, text=str(mins) + ":00" , font="Arial 256")
        self.label.pack(expand=True, fill='both')
        self.label.after(1000, self.refresh_label)

    def refresh_label(self):
        self.seconds -= 1
        
        if self.seconds <= 0:
            threading.Thread(target=run).start()
            self.seconds = int(mins * 60)
            
        if self.seconds % 60 < 10:
            text = str(floor(self.seconds / 60)) + ":0" + str(self.seconds % 60)
        else:
            text = str(floor(self.seconds / 60)) + ":" + str(self.seconds % 60)
        self.label.configure(text=text)
        
        self.label.after(1000, self.refresh_label)

timer = Timer(root)
root.mainloop()
    
        



