import tkinter as tk
import importlib
from tkinter import filedialog
from os import listdir, unlink
from os.path import isfile, join
from shutil import copy

root = tk.Tk()
root.withdraw()

main_path = filedialog.askdirectory()
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
        

